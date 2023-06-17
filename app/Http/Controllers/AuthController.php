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
        return view('/content/apps/user/app-user-view-security', ['pageConfigs' => $pageConfigs]);
    }

    // Register form
    public function new_register(RegisterRequest $request)
    {
        $data = array();
        $data['fullname'] = $request->input('register-fullname');
        $data['email'] = $request->input('register-email');
        $data['password'] = Hash::make($request->input('register-password'));
        $data['avatar'] = strtoupper(substr($data['fullname'], 0, 1)) . '.png';

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
        $email = $request->input('login-email');
        $password = $request->input('login-password');
        $account = Account::where('email', $email)->first();
        if ($account && Hash::check($password, $account->password)) {
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
            $user->address = $request->modalEditUserAddress;
            $user->avatar = strtoupper(substr($user->fullname, 0, 1)) . '.png';

            $user->save();

            Session::flash('success', 'You have changed your information');
            return response()->json(['success' => true]);
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

        // Update the user's pass
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return Redirect::back()->with('success', 'You have changed your password');
    }
}
