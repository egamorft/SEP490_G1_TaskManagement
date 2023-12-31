<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SendMailController extends Controller
{
    public function confirm_account(Request $request)
    {
        $data = $request->all();
        if (!empty($request->all())) {
            $email_to = $data['email'];
            $name = $data['name'];
            $token = $data['token'];
            $parts = explode('@', $email_to);
            $username = $parts[0];
            $domain = $parts[1];

            // Calculate the length of the username
            $usernameLength = strlen($username);

            // Calculate the number of characters to extract
            $extractLength = (int) ceil($usernameLength * 0.4);

            // Extract the last 40% of the username
            $extracted = substr($username, -$extractLength);

            // Concatenate the extracted part with the '@' symbol and the domain
            $result = $extracted . '@' . $domain;

            Mail::to($email_to)->send(new VerifyAccount($token, $name, $email_to));
            Session::flash('success', 'Email verification has sent to you, check your email to login');
            Session::flash('status', $request->status);
            Session::put('email', $email_to);
            Session::put('email_show', '****' . $result);
            return redirect()->route('verify.account', ['verify' => 'ok']);
        } else {
            abort(401);
        }
    }
}
