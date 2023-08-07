<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\BoardRequest;
use App\Http\Requests\ProjectRequest;
use App\Mail\ProjectInvitation;
use App\Models\User;
use App\Models\AccountProject;
use App\Models\Board;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Project;
use App\Models\ProjectRolePermission;
use App\Models\Role;
use App\Models\Task;
use App\Models\TaskList;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{

	public $rowPerPage = 100;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($slug)
	{
		$pageConfigs = ['pageHeader' => false];

		//Project info & members
		$project = Project::where('slug', $slug)->first();
		$accounts = $project->accounts()->get();

		$pmAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('pm', 1)
			->first();

		$supervisorAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('supervisor', 1)
			->first();

		$pendingSupervisorAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('supervisor', 0)
			->first();

		$memberAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', 1)
			->get();

		$pendingInvitedMemberAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', 0)
			->get();

		$removedMember = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', -2)
			->get();

		$checkLimitation = count($pendingInvitedMemberAccount) + count($memberAccount);

		// //Get all account not in project and active
		// $excludedAccounts = [$pmAccount->id, $supervisorAccount->id];
		// $excludedAccounts = array_merge($excludedAccounts, $memberAccount->pluck('id')->toArray());

		// $accountsBeside = User::whereNotIn('id', $excludedAccounts)
		//     ->where('is_admin', 0)
		//     ->where('status', 1)
		//     ->whereNull('deleted_at')
		//     ->get();
		// $accountsNotInProject = $accountsBeside->filter(function ($account) {
		//     return strpos($account->email, '@fe.edu.vn') === false;
		// });

		//-----------------------------------------------------------------------------------

		//Project role & permissions
		$roles = Role::all();
		$permissions = Permission::all();

		$disabledProject = $this->checkDisableProject($project);

		return view('project.settings', ['pageConfigs' => $pageConfigs, 'page' => 'settings'])
			->with(compact(
				'project',
				'pmAccount',
				'supervisorAccount',
				'memberAccount',
				'pendingInvitedMemberAccount',
				'pendingSupervisorAccount',
				'checkLimitation',
				'removedMember',
				'roles',
				'permissions',
				'disabledProject'
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
		// Convert the end date to a Carbon instance
		$endDateCarbon = Carbon::createFromFormat('Y-m-d', $endDate)->startOfDay();
		// Get the current date as a Carbon instance
		$now = Carbon::now()->startOfDay()->format('Y-m-d');
		// dd($endDateCarbon, $now);
		// Check if the end date is smaller than or equal to the current date
		if ($endDateCarbon->lte($now)) {
			// Return an error response with a 422 Unprocessable Entity status code
			return response()->json([
				'errors' => [
					'duration' => [
						'The end date must be greater than the current date.'
					]
				]
			], 422);
		}
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
		$supervisor = User::find($supervisorId);
		Mail::to($supervisor->email)->send(new ProjectInvitation($project_slug, $project_token, $project_name, $supervisor->name, 'Supervisor'));

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
			$member = User::find($memberId);
			Mail::to($member->email)->send(new ProjectInvitation($project_slug, $project_token, $project_name, $member->name, 'Member'));
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
		$projectId = $project->id;

		$accountId = Auth::user()->id;
		$check_account_project_invitation_valid = AccountProject::where('project_id', $projectId)
			->where('account_id', $accountId)->where('status', 0)
			->first();

		if ($project) {

			//Get members in project
			$accounts = $project->accounts()->wherePivot('status', 1)->withPivot('role_id')->get();
			$accountsInProject = [];

			foreach ($accounts as $account) {
				$roleId = $account->pivot->role_id;
				$role = Role::find($roleId);

				if ($role) {
					$roleName = $role->name;
					$accountName = $account->name;
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
			$totalAccounts = AccountProject::where('project_id', $projectId)->where('status', 1)->count();

			$supervisorAccounts = Project::findOrFail($projectId)
				->findAccountWithRoleNameAndStatus('supervisor', 1)
				->first();

			return view('content.project.app-project-invitation')
				->with(compact(
					'project',
					'accountsInProject',
					'totalAccounts',
					'check_account_project_invitation_valid',
					'supervisorAccounts'
				));
		} else {
			Session::flash('error', 'Something went wrong or this invitation is expired');
			return redirect()->route('dashboard');
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
	public function update(Request $request, $slug, $id)
	{
		$validatedData = $request->validate([
			'settingProjectName' => 'required|max:50',
			'settingDuration' => 'required|regex:/\d{4}-\d{2}-\d{2} to \d{4}-\d{2}-\d{2}/',
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

		// Convert the end date to a Carbon instance
		$endDateCarbon = Carbon::createFromFormat('Y-m-d', $endDate)->startOfDay();
		// Get the current date as a Carbon instance
		$now = Carbon::now()->startOfDay()->format('Y-m-d');
		// Check if the end date is smaller than or equal to the current date
		if ($endDateCarbon->lte($now)) {
			Session::flash('error', 'The end date must be greater than the current date');
			return redirect(url('/project/' . $slug));
		}

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
		$account = Auth::user();
		if ($project) {
			$accountProject = AccountProject::where('project_id', $project->id)
				->where('account_id', $account->id)
				->first();
			$check_supervisor_role = Str::endsWith($account->email, '@fe.edu.vn');
			if ($accountProject) {
				if ($request->input('approve') == 1) {
					if ($check_supervisor_role) {
						$project->project_status = 1;
						$project->save();
					}
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
		$get_project = Project::where('slug', $request->input('modalInviteSlug'))->first();
		$removedMembers = Project::findOrFail($get_project->id)
			->findAccountWithRoleNameAndStatus('member', -2)
			->get();
		$invitedMembers = Project::findOrFail($get_project->id)
			->findAccountWithRoleNameAndStatus('member', 0)
			->get();
		$currentMembers = Project::findOrFail($get_project->id)
			->findAccountWithRoleNameAndStatus('member', 1)
			->get();
		$loggedInUserEmail = Auth::user()->email;
		$exceptEmails = $removedMembers->pluck('email')->concat([$loggedInUserEmail])->merge($invitedMembers->pluck('email'))
			->merge($currentMembers->pluck('email'));
		//Handle the invitation to email
		$validatedData = $request->validate([
			'modalInviteEmail' => [
				'required', 'email',
				Rule::exists('users', 'email')
					->whereNotIn('email', $exceptEmails)
					->where(function ($query) {
						$query->whereRaw("LOCATE('@fe.edu.vn', email) = 0");
					}),
			],
			'modalInviteToken' => 'nullable',
			'modalInviteSlug' => 'nullable'
		]);
		//
		$project_slug = $validatedData['modalInviteSlug'];
		$project_token = $validatedData['modalInviteToken'];

		$project = Project::where('slug', $project_slug)->where('token', $project_token)->first();
		$invitedAccount = User::where('email', $validatedData['modalInviteEmail'])->first();
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

			Mail::to($invitedAccount->email)->send(new ProjectInvitation($project_slug, $project_token, $project->name, $invitedAccount->name, 'Member'));

			Session::flash('success', 'Successfully invite ' . $invitedAccount->name);
			// Return a response indicating the success of the operation
			return response()->json(['success' => true]);
		} else {
			// Return a response indicating the success of the operation
			return response()->json(['message' => 'Something went wrong with ' . $invitedAccount->name . ' account'], Response::HTTP_BAD_REQUEST);
		}
	}

	public function cancel_invitation(Request $request)
	{
		$project_id = $request->input('project');
		$account_id = $request->input('account');
		$account = User::findOrFail($account_id);
		$accountProject = AccountProject::where('project_id', $project_id)->where('account_id', $account_id)->first();
		if ($accountProject) {
			$accountProject->delete();
			// Row deleted successfully
			Session::flash('success', 'Cancel invitation for ' . $account->email);
			return redirect()->back();
		} else {
			// Row not found
			Session::flash('error', 'Something went wrong');
			return redirect()->back();
		}
	}

	public function remove_member(Request $request)
	{
		$project_id = $request->input('project');
		$account_id = $request->input('account');
		$account = User::findOrFail($account_id);
		$project = Project::findOrFail($project_id);
		$accountProject = AccountProject::where('project_id', $project_id)->where('account_id', $account_id)->first();
		if ($accountProject) {
			$accountProject->status = -2;
			$accountProject->save();
			// Row deleted successfully
			Session::flash('success', 'Remove ' . $account->email . ' from ' . $project->name);
			return redirect()->back();
		} else {
			// Row not found
			Session::flash('error', 'Something went wrong');
			return redirect()->back();
		}
	}

	public function set_pm(Request $request)
	{
		$old_pm_id = Auth::user()->id;
		$project_id = $request->input('project');
		$new_pm_id = $request->input('account');
		$newPmAccount = User::findOrFail($new_pm_id);
		$oldPmAccount = User::findOrFail($old_pm_id);
		// $project = Project::findOrFail($project_id);
		$newPmAccountProject = AccountProject::where('project_id', $project_id)->where('account_id', $new_pm_id)->first();
		$oldPmAccountProject = AccountProject::where('project_id', $project_id)->where('account_id', $old_pm_id)->first();
		if ($newPmAccountProject && $oldPmAccountProject) {
			//Set new pm role
			$newPmAccountProject->role_id = 1;
			$newPmAccountProject->save();
			//Set old pm role
			$oldPmAccountProject->role_id = 3;
			$oldPmAccountProject->save();
			// Row deleted successfully
			Session::flash('success', 'Change role of ' . $newPmAccount->email . ' and ' . $oldPmAccount->email);
			return redirect()->back();
		} else {
			// Row not found
			Session::flash('error', 'Something went wrong');
			return redirect()->back();
		}
	}
	public function updatePermission(Request $request)
	{
		$projectName = $request->input('projectName');
		$roleId = $request->input('roleId');
		$permissionId = $request->input('permissionId');
		$isChecked = $request->input('isChecked');

		// Find the project and role
		$project = Project::where('slug', $projectName)->first();
		$role = Role::find($roleId);

		if ($project && $role) {
			if ($isChecked === "true") {
				// Attach the permission to the role in the project
				$project->roles()->attach($roleId, ['permission_id' => $permissionId]);
				Session::flash('success', 'Permission attach successfully');
				return response()->json(['message' => 'Permission attach successfully']);
			} else {
				// Detach the permission from the role in the project
				ProjectRolePermission::where('project_id', $project->id)->where('role_id', $roleId)
					->where('permission_id', $permissionId)
					->delete();
				Session::flash('success', 'Permission detach successfully');
				return response()->json(['message' => 'Permission detach successfully']);
			}
		}

		Session::flash('error', 'Project or role not found');
		return response()->json(['message' => 'Project or role not found'], 404);
	}

	/**
	 * Display a report view of project
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function view_report_member($slug, $user_id)
	{
		$pageConfigs = [
			'pageHeader' => false,
		];

		//Project info & members
		$project = Project::where('slug', $slug)->first();
		$accounts = $project->accounts()->get();

		$pmAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('pm', 1)
			->first();

		$supervisorAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('supervisor', 1)
			->first();

		$memberAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', 1)
			->get();

		//Check disabled and calculate project progress
		$disabledProject = $this->checkDisableProject($project);
		$result = $this->calculateProjectProgress($project);
		$days_left = $result["days_left"];
		$percent_completed = $result["percent_completed"];
		if ($days_left < 0) {
			if (!$disabledProject) {
				$disabledProject = true;
			}
		}
		//Check disabled and calculate project progress
		$user = User::where('id', $user_id)->first();

		$boards = Board::where('project_id', $project->id)->with('tasks')->get();
		$tasks = [];
		$todoTasks = [];
		$doingTasks = [];
		$reviewingTasks = [];
		$ontimeTasks = [];
		$lateTasks = [];
		$overdueTasks = [];
		foreach ($boards as $board) {
			foreach ($board->tasks as $task) {
				if ($task->assign_to != $user->id) {
					continue;
				}
				$tasks[] = $task;
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
				}
				if ($task->status == -1) {
					$lateTasks[] = $task;
				}
			}
		}

		return view('project.member_report', ['pageConfigs' => $pageConfigs, 'page' => 'report'])
			->with(compact(
				'project',
				'pmAccount',
				'supervisorAccount',
				'memberAccount',
				'disabledProject',
				'user',
				'boards',
				'tasks',
				'todoTasks',
				'doingTasks',
				'reviewingTasks',
				'ontimeTasks',
				'lateTasks',
				'overdueTasks'
			));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function view_report($slug)
	{
		$pageConfigs = [
			'pageHeader' => false,
		];

		//Project info & members
		$project = Project::where('slug', $slug)->first();
		$accounts = $project->accounts()->get();

		$pmAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('pm', 1)
			->first();

		$supervisorAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('supervisor', 1)
			->first();

		$memberAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', 1)
			->get();

		//Check disabled and calculate project progress
		$disabledProject = $this->checkDisableProject($project);
		$result = $this->calculateProjectProgress($project);
		$days_left = $result["days_left"];
		$percent_completed = $result["percent_completed"];
		if ($days_left < 0) {
			if (!$disabledProject) {
				$disabledProject = true;
			}
		}
		//Check disabled and calculate project progress

		$boards = Board::where('project_id', $project->id)->with('tasks')->get();
		$tasks = [];
		$todoTasks = [];
		$doingTasks = [];
		$reviewingTasks = [];
		$ontimeTasks = [];
		$lateTasks = [];
		$overdueTasks = [];
		foreach ($boards as $board) {
			foreach ($board->tasks as $task) {
				if (!$task->assign_to) {
					continue;
				}
				$tasks[] = $task;
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
				}
				if ($task->status == -1) {
					$lateTasks[] = $task;
				}
			}
		}
		return view('project.report', ['pageConfigs' => $pageConfigs, 'page' => 'report'])
			->with(compact(
				'project',
				'pmAccount',
				'supervisorAccount',
				'memberAccount',
				'disabledProject',
				'boards',
				'tasks',
				'todoTasks',
				'doingTasks',
				'reviewingTasks',
				'ontimeTasks',
				'lateTasks',
				'overdueTasks'
			));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function view_board($slug)
	{
		$pageConfigs = ['pageHeader' => false];
		//Project info & members
		$project = Project::where('slug', $slug)->first();
		$accounts = $project->accounts()->get();

		$pmAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('pm', 1)
			->first();

		$supervisorAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('supervisor', 1)
			->first();

		$memberAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', 1)
			->get();

		//Check disabled and calculate project progress
		$disabledProject = $this->checkDisableProject($project);
		$result = $this->calculateProjectProgress($project);
		$days_left = $result["days_left"];
		$percent_completed = $result["percent_completed"];
		if ($days_left < 0) {
			Session::flash('projectState', 'Your project have been end');
			if (!$disabledProject) {
				$disabledProject = true;
			}
		}
		//Check disabled and calculate project progress

		$boards = Board::where('project_id', $project->id)->with('tasks')->get();

		return view('project.board', ['pageConfigs' => $pageConfigs, 'page' => 'board'])
			->with(compact(
				'project',
				'pmAccount',
				'supervisorAccount',
				'memberAccount',
				'disabledProject',
				'boards',
				'percent_completed',
				'days_left'
			));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function view_board_kanban($slug, $board_id, Request $request)
	{
		$pageConfigs = [
			'pageHeader' => false,
			'pageClass' => 'kanban-application',
		];

		//Get modal task details params
		$show = request()->query('show');
		$task_id = request()->query('task_id');
		$taskDetails = null;
		if ($show == "task") {
			$taskDetails = Task::with('assignTo', 'createdBy')->findOrFail($task_id);
			// dd($taskDetails);
		}

		$q = $request->query('q');
		$dueToday = $request->query('dueToday');
		$overdue = $request->query('overdue');
		$dueTomorrow = $request->query('dueTomorrow');
		$dueNextWeek = $request->query('dueNextWeek');
		$doneTask = $request->query('doneTask');
		$doingTask = $request->query('doingTask');

		//Project info & members
		$project = Project::where('slug', $slug)->first();
		$accounts = $project->accounts()->get();

		$board = Board::findOrFail($board_id);

		$disabledProject = $this->checkDisableProject($project);

		//Bind data for kanban
		$taskLists = TaskList::where('board_id', $board_id)->get();
		$kanbanData = [];
		foreach ($taskLists as $taskList) {
			//Check role to display task
			$accountRoleName = $this->getProjectRoleNameWithProjectAndAccount($slug);
			$tasks = Task::query()->where('taskList_id', $taskList->id);
			if ($accountRoleName == "member") {
				$tasks = $tasks->where('taskList_id', $taskList->id)
					->where('created_by', Auth::id())
					->orWhere('assign_to', Auth::id());
			}

			if ($q) {
				$tasks = $tasks->where('title', 'like', '%' . $q . '%');
			}
			if ($dueToday) {
				$tasks = $tasks->whereDate('due_date', '=', now()->format('Y-m-d'));
			}
			if ($overdue) {
				$tasks = $tasks->whereDate('due_date', '<', now()->format('Y-m-d'));
			}
			if ($dueTomorrow) {
				$tasks = $tasks->whereDate('due_date', '=', now()->addDay()->format('Y-m-d'));
			}
			if ($dueNextWeek) {
				$tasks = $tasks->whereDate('due_date', '=', now()->addWeek()->format('Y-m-d'));
			}
			if ($doneTask) {
				$tasks = $tasks->where('status', 4);
			}
			if ($doingTask) {
				$tasks = $tasks->where('status', 2);
			}

			$tasks = $tasks
				->orderByRaw("FIELD(status, 1, 2, 0, 3, -1)")
				->whereNull('deleted_at')
				->get();

			$taskItems = [];

			foreach ($tasks as $task) {
				$attachmentsCount = $task->attachments ? count(json_decode($task->attachments, true)) : 0;
				$flags = $this->checkDueDate($task->due_date);
				// dd($task);
				$taskItem = [
					'taskList_id' => $task->taskList_id,
					'id' => $task->id,
					'title' => $task->title,
					'comments' => $task->comments()->count(), // replace with actual comments count
					'badge-text' => $task->due_date ?? "", // replace with actual badge text
					'badge' => $flags['badgeColor'],
					'due-date' => $task->due_date ?? "", // replace with actual due date
					'attachments' => $attachmentsCount, // replace with actual attachments count
					'assigned' => $task->assignTo->avatar ?? "", // replace with actual assigned members
					'members' => $task->assignTo->name ?? "" // replace with actual members
				];

				$taskItems[] = $taskItem;
			}

			// Generate the dragTo array
			$dragTo = [];
			foreach ($taskLists as $otherTaskList) {
				if ($otherTaskList->id != $taskList->id) {
					$dragTo[] = 'taskList_' . $otherTaskList->id;
				}
			}

			if(!in_array($taskList->id, collect($taskItems)->pluck('taskList_id')->toArray())){
				$taskItems = [];
			}
			$kanbanData[] = [
				'id' => 'taskList_' . $taskList->id,
				'title' => $taskList->title,
				'dragTo' => $dragTo,
				'item' => $taskItems
			];
		}
		$current_role = $project->userCurrentRole();
		// dd($kanbanData);

		return view('project.kanban', ['pageConfigs' => $pageConfigs, 'page' => 'board', 'tab' => 'kanban'])
			->with(compact(
				'project',
				'board',
				'disabledProject',
				'kanbanData',
				'current_role',
			));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function view_gantt($slug)
	{
		$pageConfigs = [
			'pageHeader' => false,
		];

		//Project info & members
		$project = Project::where('slug', $slug)->first();
		$accounts = $project->accounts()->get();

		$pmAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('pm', 1)
			->first();

		$supervisorAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('supervisor', 1)
			->first();

		$memberAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', 1)
			->get();

		$disabledProject = $this->checkDisableProject($project);

		return view('project.gantt', ['pageConfigs' => $pageConfigs, 'page' => 'gantt'])
			->with(compact(
				'project',
				'pmAccount',
				'supervisorAccount',
				'memberAccount',
				'disabledProject'
			));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function view_board_calendar($slug, $board_id, Request $request)
	{
		$pageConfigs = [
			'pageHeader' => false,
		];

		$q = $request->query('q');
		$role = $request->query('role');

		//Project info & members
		$project = Project::where('slug', $slug)->first();
		$accounts = $project->accounts()->get();

		$board = Board::findOrFail($board_id);
		$disabledProject = $this->checkDisableProject($project);

		$taskLists = TaskList::where('board_id', $board_id)->get();

		$taskListIds = [];
		foreach ($taskLists as $taskList) {
			$taskListIds[] = $taskList->id;
		}

		$user = Auth::user();

		$tasksInProject = [];
		$tasksInProjectBuilder = Task::whereIn("taskList_id", $taskListIds);
		if ($role == 'creator') {
			$tasksInProjectBuilder = $tasksInProjectBuilder->where("created_by", $user->id);
		}

		if ($role == 'assignee') {
			$tasksInProjectBuilder = $tasksInProjectBuilder->where("assign_to", $user->id);
		}

		$tasksInProject = $tasksInProjectBuilder->get();

		$memberAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', 1)
			->get();

		$accountRoleName = $this->getProjectRoleNameWithProjectAndAccount($slug);
		$tasks = Task::query();
		if ($accountRoleName == "member") {
			$tasks = $tasks->where('created_by', Auth::id())
				->orWhere('assign_to', Auth::id());
		}
		if ($q) {
			$tasks = $tasks->where('title', 'like', '%' . $q . '%');
		}
		if ($role == "creator") {
			$tasks = $tasks->where('created_by', Auth::id());
		}
		if ($role == "assignee") {
			$tasks = $tasks->where('assign_to', Auth::id());
		}
		$tasks = $tasks
			->with('assignTo', 'comments', 'createdBy')
			->whereNull('deleted_at')
			->get();
		$tasksCalendar = [];

		foreach ($tasks as $task) {
			$task_status = $this->checkTaskStatus($task->status, $task);
			$taskCalendar = [
				"id" => $task->id,
				"title" => $task->title,
				"start" => $task->start_date,
				"end" => Carbon::parse($task->due_date)->endOfDay(),
				"extendedProps" => [
					"calendar" => $task_status
				]
			];
			$tasksCalendar[] = $taskCalendar;
		}

		return view('project.calendar', ['pageConfigs' => $pageConfigs, 'page' => 'board', 'tab' => 'calendar'])
			->with(compact(
				'project',
				'disabledProject',
				'board',
				'tasksCalendar',
				'taskLists',
				'memberAccount',
				'tasksInProject'
			));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function view_board_list(Request $request, $slug, $board_id)
	{
		$pageConfigs = [
			'pageHeader' => false,
			'pageClass' => 'kanban-application',
		];

		$role = $request->get("role");
		$query = $request->get("q");

		//Project info & members
		$project = Project::where('slug', $slug)->first();
		$accounts = $project->accounts()->get();
		$disabledProject = $this->checkDisableProject($project);

		$pmAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('pm', 1)
			->first();

		$supervisorAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('supervisor', 1)
			->first();

		$memberAccount = Project::findOrFail($project->id)
			->findAccountWithRoleNameAndStatus('member', 1)
			->get();

		$board = Board::findOrFail($board_id);

		//Bind data for kanban
		$taskLists = TaskList::where('board_id', $board_id)->get();
		$taskListsId = [];
		$taskListsArray = [];
		foreach ($taskLists as $taskList) {
			$taskListsId[] = $taskList->id;
			$taskListsArray[$taskList->id] = $taskList;
		}

		$user = Auth::user();

		$tasksInProject = [];
		$tasksInProjectBuilder = Task::whereIn("taskList_id", $taskListsId);
		if ($role == 'creator') {
			$tasksInProjectBuilder = $tasksInProjectBuilder->where("created_by", $user->id);
		}

		if ($role == 'assignee') {
			$tasksInProjectBuilder = $tasksInProjectBuilder->where("assign_to", $user->id);
		}

		if ($query) {
			$query = explode(" ", $query);
			foreach ($query as $str) {
				$tasksInProjectBuilder = $tasksInProjectBuilder->where('title', 'like', '%' . $str . '%');
			}
		}

		$totalRecords = $tasksInProjectBuilder->count();
		$tasksInProject = $tasksInProjectBuilder
			// ->skip(0)
			// ->take($this->rowPerPage)
			->get();
		$rowPerPage = $this->rowPerPage;

		return view('project.list', ['pageConfigs' => $pageConfigs, 'page' => 'board', 'tab' => 'list'])
			->with(compact(
				'accounts',
				'project',
				'pmAccount',
				'supervisorAccount',
				'memberAccount',
				'disabledProject',
				'board',
				'taskLists',
				'tasksInProject',
				'totalRecords',
				'rowPerPage'
			));
	}

	public function add_board(BoardRequest $request)
	{
		Board::create([
			'title' => $request->input('modalBoardName'),
			'project_id' => $request->input('project_id'),
		]);

		Session::flash('success', 'Create successfully board');
		// Redirect or return a response
		return response()->json(['success' => true]);
	}

	public function edit_board(Request $request)
	{
		$board = Board::findOrFail($request->input('id'));
		$request->validate([
			'modalBoardTitleEdit' => [
				'required',
				'max:100',
				Rule::unique('boards', 'title')->ignore($board->id),
			],
		]);
		$board->title = $request->input('modalBoardTitleEdit');
		$board->save();

		Session::flash('success', 'Edit successfully board');
		// Redirect or return a response
		return response()->json(['success' => true]);
	}
	public function remove_board(Request $request)
	{
		$board = Board::findOrFail($request->input('id'));
		$board->delete();

		Session::flash('success', 'Deleted board ' . $board->title);
		// Redirect or return a response
		return response()->json(['success' => true]);
	}

	public function checkDisableProject($project)
	{
		switch ($project->project_status) {
			case -1:
				Session::put('projectState', 'Your project is being rejected by your supervisor!!');
				return true;
				break;

			case 0:
				Session::put('projectState', 'Waiting for your supervisor to join the project...');
				return true;
				break;

			case 1:
				return false;
				break;

			case 2:
				Session::put('projectState', 'Your project is being approved by your supervisor :D');
				return true;
				break;

			default:
				Session::put('projectState', 'You can not use this project anymore!!');
				return true;
				break;
		}
	}

	public function add_task_modal(Request $request)
	{
		Session::flash('error', 'Something went wrong');
		return redirect()->back();
	}

	public function edit_task_modal(Request $request, $slug, $board_id, $task_id)
	{

		Session::flash('error', 'Something went wrong');
		return redirect()->back();
	}

	public function add_task_list_modal(Request $request)
	{

		Session::flash('error', 'Something went wrong');
		return redirect()->back();
	}

	public function calculateProjectProgress($project)
	{

		// Convert the project's start and end dates to Carbon objects
		$start_date = Carbon::parse($project->start_date)->startOfDay();
		$end_date = Carbon::parse($project->end_date)->endOfDay();
		// Get the current date as a Carbon object
		$current_date = Carbon::now();

		$percent_completed = 0;
		$days_left = 0;

		if ($end_date > $start_date) {
			if ($current_date < $start_date) {
				// If the project is in the future, set percent_completed to 0
				$percent_completed = 0;
				$days_left = $start_date->diffInDays($current_date);
			} elseif ($current_date >= $end_date) {
				// If the project is completed, set percent_completed to 100
				$percent_completed = 100;
				$days_left = -1;
			} else {
				// Calculate the total duration of the project in days
				$total_days = $start_date->diffInDays($end_date) + 1;

				// Calculate the number of days that have already passed since the project started
				$days_passed = $start_date->diffInDays($current_date) + 1;

				// Calculate the percentage completed
				$percent_completed = round($days_passed / $total_days * 100, 2);

				// Calculate the number of days left
				$days_left = $total_days - $days_passed;
			}
		}
		// Make sure percent_completed is within the range of 0 to 100
		$percent_completed = max(0, min(100, $percent_completed));

		return array("percent_completed" => $percent_completed, "days_left" => $days_left);
	}

	// **
	public function checkDueDate($dueDate)
	{
		$now = Carbon::now()->format('Y-m-d');
		$daysDifference = Carbon::parse($now)->diffInDays(Carbon::parse($dueDate), false);
		$onGoingDue = false;
		$warningDue = false;
		$overDue = false;

		if ($daysDifference > 0) {
			// Due date is in the future
			if ($daysDifference == 1) {
				$warningDue = true;
			} elseif ($daysDifference > 1) {
				$onGoingDue = true;
			}
		} elseif ($daysDifference == 0) {
			// Due date is today
			$warningDue = true;
		} else {
			// Due date is in the past
			$overDue = true;
		}

		$badgeColor = $onGoingDue ? 'success' : ($warningDue ? 'warning' : ($overDue ? 'danger' : ''));
		return compact('onGoingDue', 'warningDue', 'overDue', 'badgeColor');
	}

	public function getProjectRoleNameWithProjectAndAccount($currentProjectSlug)
	{
		$currentProjectId = Project::where('slug', $currentProjectSlug)->value('id');
		$currentAccountId = Auth::id();
		// $currentAccountSlug = Auth::user()->email;
		$roleId = AccountProject::where('project_id', $currentProjectId)
			->where('account_id', $currentAccountId)
			->where('status', '1')
			->value('role_id');
		$roleName = Role::where('id', $roleId)->value('name');
		return $roleName;
	}

	public function checkTaskStatus($status, $task)
	{
		$props = "";
		switch ($status) {
			case -1:
				$props = "Late";
				break;

			case 0:
				if ($task->due_date < now()->format('Y-m-d')) {
					$props = "Overdue";
					break;
				}
				$props = "Todo";
				break;

			case 1:
				if ($task->due_date < now()->format('Y-m-d')) {
					$props = "Overdue";
					break;
				}
				$props = "Doing";
				break;

			case 2:
				$props = "Reviewing";
				break;

			case 3:
				$props = "Done";
				break;

			default:
				$props = "Undefined";
				break;
		}
		return $props;
	}


	public function save_gantt(Request $request)
	{
		Session::flash('error', 'Something went wrong');
		return redirect()->back();
	}

	public function remove_taskList(Request $request)
	{
		$taskList = TaskList::findOrFail($request->input('id'));
		$taskList->delete();

		Session::flash('success', 'Deleted taskList ' . $taskList->title);
		// Redirect or return a response
		return back();
	}

	public function rejectProject(Request $request)
	{
		$project = Project::findOrFail($request->id);
		$project->description = $request->reason;
		$project->project_status = -1;
		$project->save();
		
        return response()->json(['success' => true]);
	}

	public function approveProject(Request $request)
	{
		$project = Project::findOrFail($request->id);
		$project->description = $request->reason;
		$project->project_status = 2;
		$project->save();
		
        return response()->json(['success' => true]);
	}
}
