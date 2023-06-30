<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\AccountProject;
use App\Models\PermissionRole;
use App\Models\Project;
use App\Models\ProjectRolePermission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        return view('content.components.component-tabs')
            ->with(compact(
                'project'
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

        $project = Project::create([
            'name' => $project_name,
            'project_status' => 0,
            'slug' => $project_slug,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $request->input('modalAddDesc'),
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
            'role_id' => $pmRoleId
        ]);

        $supervisorRoleId = Role::where('name', 'supervisor')->pluck('id')->first();
        // Associate supervisor with the project
        $supervisorId = $request->input('modalAddSupervisor');
        AccountProject::create([
            'project_id' => $project->id,
            'account_id' => $supervisorId,
            'role_id' => $supervisorRoleId
        ]);

        $memberRoleId = Role::where('name', 'member')->pluck('id')->first();
        // Associate members with the project
        $memberIds = $request->input('modalAddMembers');
        foreach ($memberIds as $memberId) {
            AccountProject::create([
                'project_id' => $project->id,
                'account_id' => $memberId,
                'role_id' => $memberRoleId
            ]);
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
}
