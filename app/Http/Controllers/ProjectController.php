<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Mail\ProjectInvitation;
use App\Models\Account;
use App\Models\AccountProject;
use App\Models\PermissionRole;
use App\Models\Project;
use App\Models\ProjectRolePermission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $project = Project::where('slug', $slug)->first();
        $accounts = $project->accounts()->get();

        $pmAccount = Project::findOrFail($project->id)->accountsWithRole("pm")->first();
        $supervisorAccount = Project::findOrFail($project->id)->accountsWithRole("supervisor")->first();
        $memberAccount = Project::findOrFail($project->id)->accountsWithRole("member")->get();

        // //Get all account not in project and active
        // $excludedAccounts = [$pmAccount->id, $supervisorAccount->id];
        // $excludedAccounts = array_merge($excludedAccounts, $memberAccount->pluck('id')->toArray());

        // $accountsBeside = Account::whereNotIn('id', $excludedAccounts)
        //     ->where('is_admin', 0)
        //     ->where('status', 1)
        //     ->whereNull('deleted_at')
        //     ->get();
        // $accountsNotInProject = $accountsBeside->filter(function ($account) {
        //     return strpos($account->email, '@fe.edu.vn') === false;
        // });

        return view('content.components.component-tabs')
            ->with(compact(
                'project',
                'pmAccount',
                'supervisorAccount',
                'memberAccount'
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $dates = $this->extractDatesFromDuration($request->input('duration'));
        // Access the start date and end date
        $startDate = $dates['start_date'];
        $endDate = $dates['end_date'];
        $project_name = $request->input('modalAddProjectName');

        $project_slug = Str::slug($project_name, '-');
        // Check if the slug already exists in the database
        if (Project::where('slug', $project_slug)->exists()) {
            // Slug already exists, create a random string to distinguish
            $random_string = Str::random(6); // Adjust the length of the random string as needed

            // Append the random string in reverse order to the slug
            $project_slug = $project_slug . '-' . strrev($random_string);
        }
        $project_token = Str::uuid()->toString();

        $project = Project::create([
            'name' => $project_name,
            'project_status' => 0,
            'slug' => $project_slug,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $request->input('modalAddDesc'),
            'token' => $project_token,
            'created_at' => Carbon::now(),
        ]);

        /**
         * Add a record to the database.
         *
         * @return AccountProject table
         */

        $pmRoleId = Role::where('name', 'pm')->pluck('id')->first();
        // Associate pm with the project
        AccountProject::create([
            'project_id' => $project->id,
            'account_id' => auth()->user()->id,
            'role_id' => $pmRoleId,
            'status' => 1
        ]);

        $supervisorRoleId = Role::where('name', 'supervisor')->pluck('id')->first();
        // Associate supervisor with the project
        $supervisorId = $request->input('modalAddSupervisor');
        AccountProject::create([
            'project_id' => $project->id,
            'account_id' => $supervisorId,
            'role_id' => $supervisorRoleId,
            'status' => 0
        ]);
        $supervisor = Account::find($supervisorId);
        Mail::to($supervisor->email)->send(new ProjectInvitation($project_slug, $project_token, $project_name, $supervisor->fullname, 'Supervisor'));

        $memberRoleId = Role::where('name', 'member')->pluck('id')->first();
        // Associate members with the project
        $memberIds = $request->input('modalAddMembers');
        foreach ($memberIds as $memberId) {
            AccountProject::create([
                'project_id' => $project->id,
                'account_id' => $memberId,
                'role_id' => $memberRoleId,
                'status' => 0
            ]);
            $member = Account::find($memberId);
            Mail::to($member->email)->send(new ProjectInvitation($project_slug, $project_token, $project_name, $member->fullname, 'Member'));
        }

        /**
         * @return PermisisonRole as default
         * Add a record to the database. 
         * @return ProjectRolePermission table
         */

        $defaultPermissions = PermissionRole::all();

        foreach ($defaultPermissions as $dp) {
            ProjectRolePermission::create([
                'project_id' => $project->id,
                'role_id' => $dp->role_id,
                'permission_id' => $dp->permission_id,
            ]);
        }
        Session::flash('success', 'Create successfully project ' . $project_name);
        // Return a response indicating the success of the operation
        return response()->json(['success' => true, 'message' => $project_name . ' created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $token)
    {
        //Invitation page
        $project = Project::where('slug', $slug)->where('token', $token)->first();

        $accountId = Auth::user()->id;
        $check_account_project_invitation_valid = AccountProject::where('project_id', $project->id)
            ->where('account_id', $accountId)->where('status', 0)
            ->first();

        if ($check_account_project_invitation_valid) {
            if ($project) {

                //Get members in project
                $accounts = $project->accounts()->wherePivot('status', 1)->withPivot('role_id')->get();
                $accountsInProject = [];

                foreach ($accounts as $account) {
                    $roleId = $account->pivot->role_id;
                    $role = Role::find($roleId);

                    if ($role) {
                        $roleName = $role->name;
                        $accountName = $account->fullname;
                        $accountEmail = $account->email;
                        $accountAvatar = $account->avatar;

                        $accountsInProject[] = [
                            'accountEmail' => $accountEmail,
                            'accountName' => $accountName,
                            'accountAvatar' => $accountAvatar,
                            'roleName' => $roleName,
                        ];
                    }
                }

                //Get total members in project
                $totalAccounts = AccountProject::where('project_id', $project->id)->where('status', 1)->count();

                return view('content.project.app-project-invitation')
                    ->with(compact(
                        'project',
                        'accountsInProject',
                        'totalAccounts'
                    ));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
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
        $validatedData = $request->validate([
            'settingProjectName' => 'required|max:50',
            'settingDuration' => 'required',
            'settingDesc' => 'nullable'
        ]);

        $project = Project::findOrFail($id);

        $project_slug = Str::slug($request->input('settingProjectName'), '-');
        // Check if the slug already exists in the database
        if (Project::where('slug', $project_slug)->exists()) {
            // Slug already exists, create a random string to distinguish
            $random_string = Str::random(8); // Adjust the length of the random string as needed

            // Append the random string in reverse order to the slug
            $project_slug = $project_slug . '-' . strrev($random_string);
        }

        $dates = $this->extractDatesFromDuration($request->input('settingDuration'));
        // Access the start date and end date
        $startDate = $dates['start_date'];
        $endDate = $dates['end_date'];

        $project->name = $request->input('settingProjectName');
        $project->slug = $project_slug;
        $project->start_date = $startDate;
        $project->end_date = $endDate;
        $project->description = $request->input('settingDesc');

        $project->save();

        Session::flash('success', 'Edit successfully project-' . $request->input('settingProjectName'));
        // Return a response indicating the success of the operation
        return redirect(url('/project/' . $project_slug));
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

    public function extractDatesFromDuration($duration)
    {
        $startDate = '';
        $endDate = '';

        // Extract start date and end date
        if (strpos($duration, ' to ') !== false) {
            [$startDate, $endDate] = explode(' to ', $duration);
        }

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invitation(Request $request, $slug, $token)
    {
        //Handle the invitation submit
        $project = Project::where('slug', $slug)->where('token', $token)->first();
        $accountId = Auth::user()->id;
        if ($project) {
            $accountProject = AccountProject::where('project_id', $project->id)
                ->where('account_id', $accountId)
                ->first();
            if ($accountProject) {
                if ($request->input('approve') == 1) {
                    $accountProject->status = 1;
                    $accountProject->save();
                    Session::flash('success', 'You have success to join the ' . $project->name);
                    // Return a response indicating the success of the operation
                    return redirect(url('/project/' . $project->slug));
                } elseif ($request->input('decline') == 1) {
                    $accountProject->status = -1;
                    $accountProject->save();
                    Session::flash('success', 'You have decline the invitation');
                    // Return a response indicating the success of the operation
                    return redirect()->route('dashboard');
                } else {
                    Session::flash('error', 'Something went wrong');
                    return redirect()->back();
                }
                // Perform any additional actions or return a response as needed
            } else {
                Session::flash('error', 'Something went wrong');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Something went wrong or this invitation is expired');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invite_email(Request $request)
    {
        //Handle the invitation to email
        $validatedData = $request->validate([
            'modalInviteEmail' => ['required', 'email', 'exists:accounts,email'],
            'modalInviteToken' => 'nullable',
            'modalInviteSlug' => 'nullable'
        ]);
        $project_slug = $validatedData['modalInviteSlug'];
        $project_token = $validatedData['modalInviteToken'];

        $project = Project::where('slug', $project_slug)->where('token', $project_token)->first();
        $invitedAccount = Account::where('email', $validatedData['modalInviteEmail'])->first();
        if (
            $invitedAccount &&
            $invitedAccount->is_admin == 0 &&
            $invitedAccount->status == 1 &&
            $invitedAccount->deleted_at == null
        ) {
            $memberRoleId = Role::where('name', 'member')->pluck('id')->first();

            AccountProject::create([
                'project_id' => $project->id,
                'account_id' => $invitedAccount->id,
                'role_id' => $memberRoleId,
                'status' => 0
            ]);

            Mail::to($invitedAccount->email)->send(new ProjectInvitation($project_slug, $project_token, $project->name, $invitedAccount->fullname, 'Member'));

            Session::flash('success', 'Successfully invite ' . $invitedAccount->fullname);
            // Return a response indicating the success of the operation
            return response()->json(['success' => true]);
        } else {
            // Return a response indicating the success of the operation
            return response()->json(['message' => 'Something went wrong with ' . $invitedAccount->fullname . ' account'], Response::HTTP_BAD_REQUEST);
        }
    }
}
