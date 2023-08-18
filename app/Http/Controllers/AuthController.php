<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Mail\WelcomeSocial;
use App\Models\AccountProject;
use App\Models\Project;
use App\Models\User;
use App\Models\Social;
use App\Models\Task;
use DateTime;
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

    // User User Page
    public function user_view_account()
    {
        $pageConfigs = ['pageHeader' => true];
        $account = Auth::user();
        $accountProjects = $account->projects()->wherePivot('status', 1)->get();
        $doneProjects = $account->projects()->wherePivot('status', 1)->where('project_status', '==', 2)->get();
        $projectDone = count($doneProjects);

        $allAccounts = User::all();
        $allAccountProjects = AccountProject::all();
        $allProjects = Project::all();

        $tasks = [];
        $todoTasks = [];
        $doingTasks = [];
        $reviewingTasks = [];
        $ontimeTasks = [];
        $lateTasks = [];
        $overdueTasks = [];
        $taskDone = 0;
        $tasks = Task::where('assign_to', $account->id)->get();

        foreach ($tasks as $task) {
            if ($task->assign_to != $account->id) {
                continue;
            }
            $duedate = new DateTime($task->due_date);
            if (($task->status == 0 || $task->status == 1) && (new DateTime() > $duedate->setTime(23, 59, 59)) && $task->due_date) {
                $overdueTasks[] = $task;
                continue;
            }
            if ($task->status == 0) {
                $todoTasks[] = $task;
            }
            if ($task->status == 1) {
                $doingTasks[] = $task;
            }
            if ($task->status == 2) {
                $reviewingTasks[] = $task;
            }
            if ($task->status == 3) {
                $ontimeTasks[] = $task;
                $taskDone++;
            }
            if ($task->status == -1) {
                $lateTasks[] = $task;
                $taskDone++;
            }
        }

        $social = Social::where('account_id', Auth::user()->id)->first();

        return view('content.apps.user.app-user-view-account', ['pageConfigs' => $pageConfigs])->with(compact(
            'account',
            'accountProjects',
            'allAccounts',
            'allAccountProjects',
            'tasks',
            'todoTasks',
            'doingTasks',
            'reviewingTasks',
            'ontimeTasks',
            'lateTasks',
            'overdueTasks',
            'taskDone',
            'projectDone',
            'social'
        ));
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
        $data['name'] = $request->input('register-fullname');
        $data['email'] = $request->input('register-email');
        $data['password'] = Hash::make($request->input('register-password'));
        $data['avatar'] = strtoupper(substr($data['name'], 0, 1)) . '.png';
        $data['token'] = mt_rand(100000, 999999);
        $data['status'] = 0;

        $account_id = User::insertGetId($data);
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
        $account = User::where('email', $email)->first();
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
            if ($account->password == "") {
                return Redirect::back()
                    ->withInput()->with('error', 'Check again your social');
            } else {
                return Redirect::back()
                    ->withInput()->with('error', 'Wrong username or password');
            }
        }
    }

    // Edit profile form
    public function edit_profile(ProfileRequest $request)
    {
        $id = Auth::user()->id;
        // handle form submission
        if ($request->validated()) {
            // validation passed
            $user = User::findOrFail($id);

            if ($user->status == 1) {
                // Update the user's information
                $user->name = $request->modalEditUserFullname;
                $user->address = $request->modalEditUserAddress;
                $user->avatar = strtoupper(substr($user->name, 0, 1)) . '.png';

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

        $user = User::findOrFail($id);
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
        $account = User::where('email', $email)->first();
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
        $email_exist = User::where('email', $data['forgot-password-email'])->first();
        if ($email_exist) {
            if ($email_exist->password != "") {
                $email_to = $data['forgot-password-email'];
                $token = md5(uniqid());
                $account = User::where('email', $email_to)->first();
                $account->token = $token;
                $account->save();
            } else {
                return redirect()->back()->withInput()->with('error', 'Check again your social login');
            }

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
            $account = User::where('token', $token)->first();
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

        $account = User::where('token', $token)->first();
        $account->token = null;
        $account->password = Hash::make($new_password);
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
        $social = Social::where('provider', 'FACEBOOK')
            ->where('provider_user_id', $provider->getId())
            ->first();
        if ($social) {
            //Existed in system
            $account = User::findOrFail($social->account_id);
            Auth::login($account);
            return redirect()->route('dashboard')->with('success', 'Successfully login with facebook');
        } else {
            $result = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'FACEBOOK'
            ]);

            //Check email facebook exist?
            $orang = User::where('email', $provider->getEmail())->first();

            if (!$orang) {
                //Create new
                $orang = User::create([

                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'address' => '',
                    'avatar' => strtoupper(substr($provider->getName(), 0, 1)) . '.png',
                    'status' => 1

                ]);
            }
            $result->account()->associate($orang);
            $result->save();

            Mail::to($provider->getEmail())->send(new WelcomeSocial('Facebook', $provider->getName(), $provider->getEmail()));
            Auth::login($orang);
            return redirect()->route('dashboard')->with('success', 'Successfully login with facebook');
        }
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        $provider = Socialite::driver('google')->stateless()->user();
        $social = Social::where('provider', 'GOOGLE')
            ->where('provider_user_id', $provider->getId())
            ->first();
        if ($social) {
            //Existed in system
            $account = User::findOrFail($social->account_id);
            Auth::login($account);
            return redirect()->route('dashboard')->with('success', 'Successfully login with google');
        } else {
            $result = new Social([
                'provider_user_id' => $provider->id,
                'provider' => 'GOOGLE'
            ]);
            //Check email google exist?
            $orang = User::where('email', $provider->getEmail())->first();

            if (!$orang) {
                //Create new
                $orang = User::create([

                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'address' => '',
                    'avatar' => strtoupper(substr($provider->getName(), 0, 1)) . '.png',
                    'status' => 1

                ]);
            }
            $result->account()->associate($orang);
            $result->save();

            Mail::to($provider->getEmail())->send(new WelcomeSocial('Google', $provider->getName(), $provider->getEmail()));
            Auth::login($orang);
            return redirect()->route('dashboard')->with('success', 'Successfully login with google');
        }
    }
}
