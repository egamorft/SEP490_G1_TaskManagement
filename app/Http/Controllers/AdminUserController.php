<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\AdminRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $getAllAccount = User::all();
        $totalAccount = count($getAllAccount);
        $totalActiveAccount = count($getAllAccount->where('status', 1));
        $totalInactiveAccount = count($getAllAccount->where('status', 0));
        $totalBannedAccount = count($getAllAccount->whereNotNull('deleted_at'));
        return view('content.apps.user.app-user-list', ['pageConfigs' => $pageConfigs])
            ->with(compact(
                'totalAccount',
                'totalActiveAccount',
                'totalInactiveAccount',
                'totalBannedAccount',
                'getAllAccount'
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AdminRegisterRequest $request)
    {
        $data = array();
        $data['name'] = $request->input('user-fullname');
        $data['email'] = $request->input('user-email');
        $data['password'] = Hash::make($request->input('user-password'));
        $data['avatar'] = strtoupper(substr($data['name'], 0, 1)) . '.png';
        $data['status'] = 1;
        $data['is_admin'] = $request->input('user-role');
        $role = "";
        if ($data['is_admin'] == 1) {
            $role = "ADMIN";
        } else {
            $role = "USER";
        }
        $account = User::insertGetId($data);
        if ($account) {
            Mail::to($data['email'])->send(new AdminRegister($data['email'], $role, $request->input('user-password')));
            Session::flash('success', 'Successfully create an account of ' . $data['email']);
            return response()->json(['success' => true]);
        } else {
            return Redirect::back()->withInput()->with('error', 'Something went wrong!! Try again');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        // Retrieve the record from the database
        $account = User::find($id);

        if ($account) {
            // Prepare the data to be sent back to the client
            $data = [
                'name' => $account->name,
                'email' => $account->email,
                'is_admin' => $account->is_admin,
                'address' => $account->address
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Record not found',
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageConfigs = ['pageHeader' => false];

        $account = User::findOrFail($id);
        return view('content.apps.admin.app-admin-view-account', ['pageConfigs' => $pageConfigs])->with(compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user-fullname' => 'required|max:50',
            'user-role' => 'required',
        ]);
        // validation passed
        $account = User::findOrFail($id);
        $account->name = $request->input('user-fullname');
        $account->is_admin = $request->input('user-role');
        $account->address = $request->input('user-address');

        // Save the model to the database
        $account->save();

        $email = $account->email;

        Session::flash('success', 'Successfully edit user ' . $email);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
