<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

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

		return view('dashboard.dashboard-member', ['pageConfigs' => $pageConfigs]);
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
