<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
    public function two_steps_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('.content.authentication.auth-two-steps-cover', ['pageConfigs' => $pageConfigs]);
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
}
