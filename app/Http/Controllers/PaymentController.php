<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Client;
use App\Models\Payment;
use App\Models\VerifyUser;
use App\Models\Policy;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

class PaymentController extends Controller
{
    public function store(Request $request)
{
    $client = Client::findOrFail($request->input('id'));

    $payment = new Payment();
    $payment->client_fname = $client->client_fname;
    $payment->client_email = $client->client_email;
    $payment->payment_period = $client->payment_period;
    $payment->premium_amount = $client->premium_amount;
    $payment->policy_type = $client->policy_type;
    $payment->payment_date = $request->input('payment_date');
    $payment->card_fname = $request->input('card_fname');
    $payment->cvv = $request->input('cvv');
    $payment->exp_date = $request->input('exp_date');
    $payment->card_number = $request->input('card_number');
    $payment->next_payment_date = $payment->calculatePremiumDueDate();

    $payment->save();

    $client->premium_due_date = $payment->next_payment_date;

    $currentAccountWallet = $client->account_wallet;
    $paymentAmount = $request->input('payment_amount');
    $updatedAccountWallet = $currentAccountWallet + $paymentAmount;
    $client->account_wallet = $updatedAccountWallet;

    $client->payment_date = $payment->payment_date;
    $client->save();

    return redirect()->route('doctor.payments');
}


    public function generatePaymentsReport()
{
    $payments = Payment::all();

    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Arial');

    $dompdf = new Dompdf($pdfOptions);
    $html = view('dashboard.doctor.payments-report', compact('payments'))->render();
    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $file_name = "payments-report.pdf";
    $output = $dompdf->output();
    file_put_contents($file_name, $output);

    return response()->download($file_name)->deleteFileAfterSend(true);
}


}
