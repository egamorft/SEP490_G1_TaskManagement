<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\AdminRegister;
use App\Models\Account;
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

        $getAllAccount = Account::all();
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
        $data['fullname'] = $request->input('user-fullname');
        $data['email'] = $request->input('user-email');
        $data['password'] = Hash::make($request->input('user-password'));
        $data['avatar'] = strtoupper(substr($data['fullname'], 0, 1)) . '.png';
        $data['status'] = 1;
        $data['is_admin'] = $request->input('user-role');
        $role = "";
        if ($data['is_admin'] == 1) {
            $role = "ADMIN";
        }else{
            $role = "USER";
        }
        $account = Account::insertGetId($data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
