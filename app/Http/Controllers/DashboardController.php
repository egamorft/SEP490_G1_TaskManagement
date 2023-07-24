<?php

namespace App\Http\Controllers;

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
	$project = Project::where('slug', "mine")->first();

    return view('dashboard.dashboard-member', ['pageConfigs' => $pageConfigs])
		->with(compact(
			'project'
		));
  }

  public function dashboard_member()
  {
    $pageConfigs = ['pageHeader' => false];
	$project = Project::where('slug', "mine")->first();

    return view('dashboard.dashboard-member', ['pageConfigs' => $pageConfigs])
		->with(compact(
			'project'
		));
  }

  public function dashboard_admin()
  {
    $pageConfigs = ['pageHeader' => false];
	$project = Project::where('slug', "mine")->first();

    return view('dashboard.dashboard-admin', ['pageConfigs' => $pageConfigs])
		->with(compact(
			'project'
		));
  }
}
