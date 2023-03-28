<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\VerifyDoctor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorController extends Controller
{
    function create(Request $request){
          //Validate inputs
          $request->validate([
             'name'=>'required',
             'email'=>'required|email|unique:doctors,email',
             'hospital'=>'required',
             'password'=>'required|min:5|max:30',
             'cpassword'=>'required|min:5|max:30|same:password'
          ]);

          $doctor = new Doctor();
          $doctor->name = $request->name;
          $doctor->email = $request->email;
          $doctor->hospital = $request->hospital;
          $doctor->password = \Hash::make($request->password);
          $save = $doctor->save();
          $last_id = $doctor->id;

          $token = $last_id.hash('sha256', \Str::random(120));
          $verifyURL = route('doctor.verify',['token'=>$token,'service'=>'Email_Verification']);
          VerifyDoctor::create([
              'doctor_id'=>$last_id,
              'token'=>$token,
          ]);

          $message = 'Dear <b>'.$request->name.'</b>';
          $message.= 'Thanks for signing up, we need you to verify your email address to complete setting up your account';

          $mail_data = [
              'recipient'=>$request->email,
              'fromEmail'=>$request->email,
              'fromName'=>$request->name,
              'subject'=>'Email verification',
              'body'=>$message,
              'actionLink'=>$verifyURL,
          ];

          \Mail::send('email-template', $mail_data, function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject']);
          });

          if( $save ){
              return redirect()->back()->with('success','You need to confirm your account. We have sent you an activation link, please check your email.');
          }else{
              return redirect()->back()->with('fail','Something went Wrong, failed to register');
          }
    }


    public function verify(Request $request){
        $token = $request->token;
        $verifyDoctor = VerifyDoctor::where('token', $token)->first();
        if(!is_null($verifyDoctor)){
            $doctor = $verifyDoctor->doctor;
            if(!$doctor->email_verified){
                 $verifyDoctor->doctor->email_verified = 1;
                 $verifyDoctor->doctor->save();
                 return redirect()->route('doctor.login')->with('info','Your email is verified. You can now login')->with('verifiedEmail', $doctor->email);
            }else{
                return redirect()->route('doctor.login')->with('info','Your email is already verified. You can now login')->with('verifiedEmail', $doctor->email);

            }
        }
    }

    function check(Request $request){
        //Validate Inputs
        $request->validate([
           'email'=>'required|email|exists:doctors,email',
           'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists in doctors table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('doctor')->attempt($creds) ){
            return redirect()->route('doctor.home');
        }else{
            return redirect()->route('doctor.login')->with('fail','Incorrect Credentials');
        }
    }

    function logout(){
        Auth::guard('doctor')->logout();
        return redirect('/');
    }

    public function showForgotForm(){
        return view('dashboard.doctor.forgot');
    }

    public function sendResetLink(Request $request){
           $request->validate([
               'email'=>'required|email|exists:doctors,email'
           ]);

           $token = \Str::random(64);
           \DB::table('password_resets')->insert([
                 'email'=>$request->email,
                 'token'=>$token,
                 'created_at'=>Carbon::now(),
           ]);
           $action_link = route('doctor.reset.password.form',['token'=>$token,'email'=>$request->email]);
           $body = "We have received a request to reset the password for <b>Your App Name</b> account associated with ".$request->email.". You can reset your password by clicking the link below.";

           \Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
                $message->from('noreply@example.com', 'Your App Name');
                $message->to($request->email, 'Doctor Name')
                        ->subject('Reset Password');
           });

           return back()->with('success', 'We have e-mailed your password reset link');
    }

    public function showResetForm(Request $request, $token = null){
        return view('dashboard.doctor.reset')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function resetPassword(Request $request){
        $request->validate([
             'email'=>'required|email|exists:doctors,email',
             'password'=>'required|min:5|confirmed',
             'password_confirmation'=>'required',
        ]);

        $check_token = \DB::table('password_resets')->where([
             'email'=>$request->email,
             'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid token');
        }else{
            Doctor::where('email', $request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('doctor.login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }
}
