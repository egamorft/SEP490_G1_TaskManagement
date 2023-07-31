<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountProject;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
	// Dashboard - Analytics
	public function dashboardAnalytics()
	{
		$pageConfigs = ['pageHeader' => false];

		return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
	}

	// Dashboard - Ecommerce
	public function dashboardEcommerce()
	{
		$pageConfigs = ['pageHeader' => false];

		return view('content.dashboard.dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
	}

	// Dashboard
	public function dashboard()
	{
		$pageConfigs = ['pageHeader' => false];
		if (!Auth::user()) {
			return view('dashboard.not-authorized', ['pageConfigs' => $pageConfigs]);
		}
		if (Auth::user()->is_admin == 0) {
			return DashboardController::dashboard_member();
		}
		return DashboardController::dashboard_admin();
	}

	public function dashboard_member()
	{
		$pageConfigs = ['pageHeader' => false];

		$account = Auth::user();
		$accountProjects = $account->projects()->wherePivot('status', 1)->get();

		$allAccounts = Account::all();
		$allAccountProjects = AccountProject::all();
        $allProjects = Project::all();

		$tasks = Task::where('assign_to', $account->id)->get();
		$validTasks = [];
		foreach($tasks as $task) {
			$taskDate = $task->due_date;
			$isTaskThisWeek = DashboardController::isTaskInWeek($taskDate, 0);
			$isTaskNextWeek = DashboardController::isTaskInWeek($taskDate, 1);
			if ($isTaskThisWeek || $isTaskNextWeek) {
				$validTasks[] = $task;
			}
		}
		$tasks = $validTasks;

		return view('dashboard.dashboard-member', ['pageConfigs' => $pageConfigs])
			->with(compact(
				'account',
				'accountProjects',
				'allAccounts',
				'allAccountProjects',
				'tasks',
			));
	}

	public function isTaskInWeek($taskDate, $weekNumber) {
		// Get the current week number
		$currentWeekNumber = (int)date('W');
		// Get the week number of the given task date
		$taskWeekNumber = (int)date('W', strtotime($taskDate));
		// Compare the week numbers to see if the task is within the desired week
		return $taskWeekNumber === $currentWeekNumber + $weekNumber;
	}

	public function dashboard_admin()
	{
		$pageConfigs = ['pageHeader' => false];

        $allProjects = Project::all();
        $rejectedProjectNumber = count($allProjects->where('project_status', -1));
        $todoProjectNumber = count($allProjects->where('project_status', 0));
        $doingProjectNumber = count($allProjects->where('project_status', 1));
        $doneProjectNumber = count($allProjects->where('project_status', 2));

        $allAccounts = Account::all();
		$allAccountProjects = AccountProject::all();

		return view('dashboard.dashboard-admin', ['pageConfigs' => $pageConfigs])
			->with(compact(
				'todoProjectNumber',
				'doingProjectNumber',
				'doneProjectNumber',
				'rejectedProjectNumber',
				'allProjects',
				'allAccounts',
				'allAccountProjects'
			));
	}
}
