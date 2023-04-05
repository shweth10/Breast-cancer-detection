<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Policy;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function add()
    {
        $policies = Policy::all();

        return view('dashboard.user.add', compact('policies'));
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.home')->with('success', 'User has been deleted');
    }
    
    function create(Request $request){
          //Validate Inputs
          $request->validate([
              'name'=>'required',
              'email'=>'required|email|unique:users,email',
              'password'=>'required|min:5|max:30',
              'cpassword'=>'required|min:5|max:30|same:password'
          ]);

          $user = new User();
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = \Hash::make($request->password);
          $save = $user->save();
          $last_id = $user->id;

          $token = $last_id.hash('sha256', \Str::random(120));
          $verifyURL = route('user.verify',['token'=>$token,'service'=>'Email_verification']);

          VerifyUser::create([
              'user_id'=>$last_id,
              'token'=>$token,
          ]);

          $message = 'Dear <b>'.$request->name.'</b>';
          $message.= ' Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

          $mail_data = [
              'recipient'=>$request->email,
              'fromEmail'=>$request->email,
              'fromName'=>$request->name,
              'subject'=>'Email Verification',
              'body'=>$message,
              'actionLink'=>$verifyURL,
          ];

          \Mail::send('email-template', $mail_data, function($message) use ($mail_data){
                     $message->to($mail_data['recipient'])
                             ->from($mail_data['fromEmail'], $mail_data['fromName'])
                             ->subject($mail_data['subject']);
          });

          if( $save ){
              return redirect()->back()->with('success','You need to verify your account. We have sent you an activation link, please check your email.');
          }else{
              return redirect()->back()->with('fail','Something went wrong, failed to register');
          }
    }

    public function verify(Request $request){
        $token = $request->token;
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(!is_null($verifyUser)){
            $user = $verifyUser->user;

            if(!$user->email_verified){
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();

                return redirect()->route('user.login')->with('info','Your email is verified successfully. You can now login')->with('verifiedEmail', $user->email);
            }else{
                 return redirect()->route('user.login')->with('info','Your email is already verified. You can now login')->with('verifiedEmail', $user->email);
            }
        }
    }

    function check(Request $request){
        //Validate inputs
        $request->validate([
           'email'=>'required|email|exists:users,email',
           'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists on users table'
        ]);

        $creds = $request->only('email','password');
        if( Auth::guard('web')->attempt($creds) ){
            return redirect()->route('user.home');
        }else{
            return redirect()->route('user.login')->with('fail','Incorrect credentials');
        }
    }

    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }


    public function showForgotForm(){
        return view('dashboard.user.forgot');
    }

    public function sendResetLink(Request $request){
         $request->validate([
             'email'=>'required|email|exists:users,email'
         ]);

         $token = \Str::random(64);
         \DB::table('password_resets')->insert([
               'email'=>$request->email,
               'token'=>$token,
               'created_at'=>Carbon::now(),
         ]);
         
         $action_link = route('user.reset.password.form',['token'=>$token,'email'=>$request->email]);
         $body = "We are received a request to reset the password for <b>Your app Name </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

        \Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
              $message->from('noreply@example.com','Your App Name');
              $message->to($request->email,'Your name')
                      ->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetForm(Request $request, $token = null){
        return view('dashboard.user.reset')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
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

            User::where('email', $request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('user.login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }
}
