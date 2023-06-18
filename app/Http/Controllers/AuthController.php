<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Account;
use App\Models\Social;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $pageConfigs = ['blankPage' => true];

        return view('content.authentication.auth-login-cover', ['pageConfigs' => $pageConfigs]);
    }

    // Register
    public function register()
    {
        $pageConfigs = ['blankPage' => true];

        return view('content.authentication.auth-register-cover', ['pageConfigs' => $pageConfigs]);
    }

    // Forgot Password
    public function forgot_password()
    {
        $pageConfigs = ['blankPage' => true];

        return view('content.authentication.auth-forgot-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    // User Account Page
    public function user_view_account()
    {
        $pageConfigs = ['pageHeader' => true];
        return view('content.apps.user.app-user-view-account', ['pageConfigs' => $pageConfigs]);
    }

    // User Security Page
    public function user_view_security()
    {
        $pageConfigs = ['pageHeader' => true];
        return view('content.apps.user.app-user-view-security', ['pageConfigs' => $pageConfigs]);
    }


    // two steps cover
    public function two_steps_cover(Request $request)
    {
        if ($request->verify) {
            $pageConfigs = ['blankPage' => true];

            return view('.content.authentication.auth-two-steps-cover', ['pageConfigs' => $pageConfigs]);
        } else {
            abort(401);
        }
    }

    // Register form
    public function new_register(RegisterRequest $request)
    {
        $data = array();
        $data['fullname'] = $request->input('register-fullname');
        $data['email'] = $request->input('register-email');
        $data['password'] = Hash::make($request->input('register-password'));
        $data['avatar'] = strtoupper(substr($data['fullname'], 0, 1)) . '.png';
        $data['token'] = mt_rand(100000, 999999);
        $data['status'] = 0;

        $account_id = Account::insertGetId($data);
        if ($account_id) {
            return redirect()->route('mail.verify.account', $data);
            // return Redirect::to('/login')->with('success', 'You have success to sign up!!');
        } else {
            return Redirect::back()->withInput()->with('error', 'Something went wrong!! Try again');
        }
    }

    // Login form
    public function login_now(LoginRequest $request)
    {
        $email = $request->input('login-email');
        $password = $request->input('login-password');
        $account = Account::where('email', $email)->first();
        if ($account && Hash::check($password, $account->password)) {
            if ($account->status == 1) {
                if (!$account->deleted_at) {
                    // Session::put('account_session', bcrypt($user->username));
                    Auth::login($account);
                    return redirect()->intended('/')->with('check-auth-first-time', '');
                } else {
                    return Redirect::back()
                        ->withInput()->with('error', 'Your account have been suspended');
                }
            } else {
                return Redirect::back()
                    ->withInput()->with('error', 'You have not verify your account');
            }
        } else {
            return Redirect::back()
                ->withInput()->with('error', 'Wrong username or password');
        }
    }

    // Edit profile form
    public function edit_profile(ProfileRequest $request)
    {
        $id = Auth::user()->id;
        // handle form submission
        if ($request->validated()) {
            // validation passed
            $user = Account::findOrFail($id);

            if ($user->status == 1) {
                // Update the user's information
                $user->fullname = $request->modalEditUserFullname;
                $user->address = $request->modalEditUserAddress;
                $user->avatar = strtoupper(substr($user->fullname, 0, 1)) . '.png';

                $user->save();

                Session::flash('success', 'You have changed your information');
                return response()->json(['success' => true]);
            } else {
                // Not verified
                $errors = 'Something went wrong with your verification';
                return response()->json(['success' => false, 'errors' => $errors]);
            }
        } else {
            // validation failed
            $errors = $request->errors();
            return response()->json(['success' => false, 'errors' => $errors]);
        }
    }

    // Change password form
    public function change_password(ChangePassRequest $request)
    {
        $id = Auth::user()->id;

        $user = Account::findOrFail($id);
        if ($user->status == 1) {
            // Update the user's pass
            $user->password = Hash::make($request->newPassword);
            $user->save();

            Session::flash('success', 'You have changed your password');
            return Redirect::back();
        } else {
            Session::flash('error', 'Something went wrong with your verification');
            return Redirect::back();
        }
    }

    //Check code verify account
    public function check_code(Request $request)
    {
        $digit1 = $request->input('input1');
        $digit2 = $request->input('input2');
        $digit3 = $request->input('input3');
        $digit4 = $request->input('input4');
        $digit5 = $request->input('input5');
        $digit6 = $request->input('input6');
        $email = $request->input('email');

        $inputToken = $digit1 . $digit2 . $digit3 . $digit4 . $digit5 . $digit6;
        $account = Account::where('email', $email)->first();
        if ($account) {
            if ($account->token == $inputToken) {
                $account->status = 1;
                $account->token = null;
                $account->save();

                Session::flash('success', 'Your account has success activated');
                return redirect()->route('login');
            } else {
                Session::flash('error', 'Wrong token!! Try again');
                return redirect()->back()->withInput();
            }
        } else {
            Session::flash('error', 'Something went wrong!! Try again');
            return redirect()->back()->withInput();
        }
    }

    //Check email which forgot
    public function check_forgot_password(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'forgot-password-email' => [
                'required',
                'exists:accounts,email'
            ],
        ]);
        if (!$validator->fails()) {
            //Passed
            $email_to = $data['forgot-password-email'];
            $token = md5(uniqid());
            $account = Account::where('email', $email_to)->first();
            $account->token = $token;
            $account->save();

            Mail::to($email_to)->send(new ResetPassword($token, $email_to));
            return redirect()->back()->withInput()->with('success', 'Check your email to reset your password');
        } else {
            //Fails
            return redirect()->back()->withInput()->with('error', 'Email is not existed in our system');
        }
    }

    //Redirect to reset new password
    public function reset_password_cover($token)
    {
        if ($token) {
            $account = Account::where('token', $token)->first();
            if ($account) {
                $pageConfigs = ['blankPage' => true];

                return view('content.authentication.auth-reset-password-cover', ['pageConfigs' => $pageConfigs, 'token' => $token]);
            } else {
                abort(401);
            }
        } else {
            abort(404);
        }
    }

    //Save reset password info
    public function reset_password(ResetPasswordRequest $request)
    {
        $new_password = $request->input('reset-password-new');
        $token = $request->input('hidden_token');

        $account = Account::where('token', $token)->first();
        $account->token = null;
        $account->password = $new_password;
        $account->save();

        Session::flash('success', 'Your password have been reset');
        return redirect()->route('login');
    }

    //Login to facebook
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        dd($provider);
        // $account = Social::where('provider', 'facebook')
        //     ->where('provider_user_id', $provider->getId())
        //     ->first();
        // if ($account) {
        //     $account_name = Account::where('account_id', $account->user)->first();
        //     Session::put('account_name', $account_name->account_name);
        //     Session::put('account_email', $account_name->account_email);
        //     Session::put('account_phone', $account_name->account_phone);
        //     Session::put('account_id', $account_name->account_id);
        //     return redirect('/shop')->with('message', 'Successfully login with facebook');
        // } else {

        //     $result = new Social([
        //         'provider_user_id' => $provider->getId(),
        //         'provider' => 'FACEBOOK'
        //     ]);

        //     $orang = Account::where('account_email', $provider->getEmail())->first();

        //     if (!$orang) {
        //         $orang = Account::create([

        //             'account_name' => $provider->getName(),
        //             'account_email' => $provider->getEmail(),
        //             'account_password' => '',
        //             'account_phone' => '',
        //             'account_confirmation' => '1'

        //         ]);
        //     }
        //     $result->login()->associate($orang);
        //     $result->save();

        //     $account_name = Account::where('account_id', $result->user)->first();

        //     Session::put('account_name', $account_name->account_name);
        //     Session::put('account_id', $account_name->account_id);
        //     return redirect('/shop')->with('message', 'Successfully login with facebook');
        // }
    }
}
