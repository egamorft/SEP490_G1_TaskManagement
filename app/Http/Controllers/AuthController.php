<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    // Register form
    public function new_register(RegisterRequest $request)
    {
        $request->except('_token');
        $data = array();
        $data['fullname'] = $request->register_fullname;
        $data['username'] = $request->register_username;
        $data['email'] = $request->register_email;
        $data['phone'] = $request->register_phone;
        $data['password'] = bcrypt($request->register_password);

        $account_id = Account::insertGetId($data);
        if ($account_id) {
            return Redirect::to('/login')->with('success', 'You have success to sign up!!');
        } else {
            return Redirect::back()->withInput()->with('error', 'Something went wrong!! Try again');
        }
    }

    // Login form
    public function login_now(LoginRequest $request)
    {
        $request->except('_token');
        $username = $request->login_username;
        $password = bcrypt($request->login_password);
        $account = Account::where('username', $username)->orWhere('email', $username)
            ->where('password', $password)->first();
        if ($account) {
            if ($account->status == 1) {
                // Session::put('account_session', bcrypt($user->username));
                Auth::login($account);
                return redirect()->intended('/')->with('check-auth-first-time', '');
            } else {
                return Redirect::back()
                    ->withInput()->with('error', 'Your account have been suspended');
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

            // Update the user's information
            $user->fullname = $request->modalEditUserFullname;
            $user->email = $request->modalEditEmail;
            $user->gender = $request->modalEditUserGender;
            $user->dob = $request->modalEditUserDob;
            $user->address = $request->modalEditUserAddress;
            $user->city_id = intval(ltrim($request->modalEditUserCity, '0'));
            $user->province_id = intval(ltrim($request->modalEditUserProvince, '0'));
            $user->ward_id = intval(ltrim($request->modalEditUserWard, '0'));

            $user->save();

            Session::flash('success', 'You have changed your information');
            return response()->json(['success' => true]);
        } else {
            // validation failed
            $errors = $request->errors();
            return response()->json(['success' => false, 'errors' => $errors]);
        }
    }

    // Edit profile form
    public function change_password(ChangePassRequest $request)
    {
        $request->except('_token');
        $id = Auth::user()->id;

        $user = Account::findOrFail($id);

        // Update the user's pass
        $user->password = bcrypt($request->newPassword);
        $user->save();

        return Redirect::back()->with('success', 'You have changed your password');
    }
}
