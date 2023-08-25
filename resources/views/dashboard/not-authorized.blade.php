@extends('layouts/contentLayoutMaster')

@section('title', 'FTask - Task Management')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/calendars/fullcalendar.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-calendar.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/not-authorize.css')) }}">
    @if (!Auth::check())
        <style>
            .app-content.content {
                padding-left: 0px !important;
                padding-right: 0px !important;
            } 
        </style>
    @endif
@endsection

@section('content')
    <!-- Not authorized-->
    {{-- <div class="misc-wrapper">
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">You are not authorized! 🔐</h2>
                <p class="mb-2">FTask - Task Management System uses the FPT Education account credentials to access the
                    serves.</p>
                <a class="btn btn-primary mb-1 btn-sm-block" href="{{ url('auth/login-cover') }}">Back to login</a>
            </div>
			<div class="w-100 text-center app-introduction">
				<h2 class='mb-1'>FTask - Task Management System</h2>
				<div class='row mb-2 app-introduction-wrapper'>
					<div class='col'>
						<div class='introduction-text'>
							Manage work progress easily
						</div>
					</div>
					<div class='col'>
						<div class='introduction-text'>
							Tracking members progress in project
						</div>
					</div>
					<div class='col'>
						<div class='introduction-text'>
							Know your workload and deadline to finish
						</div>
					</div>
				</div>
			</div>
            <div class="w-100 text-center">
                <img class="img-fluid" src="{{ asset('images/pages/login-v2.svg') }}" alt="Not authorized page" />
            </div>
        </div>
    </div> --}}

    <div class="content-wrapper content-view">
        <div class="container-fluid not-authorize-page container">
            <div class="row flex-container row-droplist">
                <div class="column col-md-6 vertical-middle">
                    <div class="component component-heading">
                        <h1 class='ftask-header'>Ftask Software make it easier than ever</h1>
                    </div>
                    <div class="component component-heading">
                        <h3 class="ftask-subtitle">
                            Explore Ftask's feature that help your team succeed in managing graduation thesis project
                        </h3>
                    </div>
                    <div class="component component-heading">
                        <h5 class="ftask-intro">
                            Include in this software version:
                        </h5>
                    </div>
    
                    <div class="component component-droplist">
                        <ul>
    
                            <li class="dropdown-checkmark">
                                <i data-feather="check" class="li-icons"></i>
                                <span>Manage user by specific role in a project</span>
                            </li>

                            <li class="dropdown-checkmark">
                                <i data-feather="check" class="li-icons"></i>
                                <span>Integrations with apexcharts to show your progress</span>
                            </li>
    
                            <li class="dropdown-checkmark">
                                <i data-feather="check" class="li-icons"></i>
                                <span>Notify whenever trigger an action with task</span>
                            </li>

                            <li class="dropdown-checkmark">
                                <i data-feather="check" class="li-icons"></i>
                                <span>Remind tasks, make user easily manage their current tasks</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="column col-md-6">
                    <img class="img-fluid" src="{{ asset('images/pages/login-v2.svg') }}" alt="Not authorized page" />
                </div>
            </div>

        </div>
        
        <div class='not-author-wrapper'>
            {{-- Kanban --}}
            <div class="container container-fluid not-authorize-feature">
                <div class="row flex-container row-droplist">
                    <div class="column col-md-6">
                        <img class="img-fluid" src="{{ asset('images/landing-page/kanban1.png') }}" alt="Not authorized page" style="border: 1px solid #eee; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" />
                    </div>
                    <div class="column col-md-6 vertical-middle">
                        <div class="component component-heading">
                            <h2 class="ftask-title">
                                Customize how your team's work flows
                            </h2>
                        </div>

                        <div class="sep">

                        </div>

                        <div class="component component-text">
                            <p class="ftask-text">Set up your team project's complicated workflow.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Calendar --}}
            <div class="container container-fluid not-authorize-feature">
                <div class="row flex-container row-droplist">
                    <div class="column col-md-6 vertical-middle">
                        <div class="component component-heading">
                            <h2 class="ftask-title">
                                Tracking your task in time
                            </h2>
                        </div>

                        <div class="sep">

                        </div>

                        <div class="component component-text">
                            <p class="ftask-text">See your progress on calendar.</p>
                        </div>
                    </div>
                    <div class="column col-md-6">
                        <img class="img-fluid" src="{{ asset('images/landing-page/calendar.png') }}" alt="Calendar description" style="border: 1px solid #eee; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" />
                    </div>
                </div>
            </div>

            <div class="container container-fluid not-authorize-feature">
                <div class="row flex-container row-droplist">
                    <div class="column col-md-6">
                        <img class="img-fluid" src="{{ asset('images/landing-page/list.png') }}" alt="List description" style="border: 1px solid #eee; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" />
                    </div>
                    <div class="column col-md-6 vertical-middle">
                        <div class="component component-heading">
                            <h2 class="ftask-title">
                                See your jobs by list
                            </h2>
                        </div>

                        <div class="sep">

                        </div>

                        <div class="component component-text">
                            <p class="ftask-text">View your task in list and know what to do next.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container container-fluid not-authorize-feature">
                <div class="row flex-container row-droplist">
                    <div class="column col-md-6 vertical-middle">
                        <div class="component component-heading">
                            <h2 class="ftask-title">
                                Graphical depiction of a project schedule
                            </h2>
                        </div>

                        <div class="sep">

                        </div>

                        <div class="component component-text">
                            <p class="ftask-text">View your task in a Gantt chart show your start and finish dates.</p>
                        </div>
                    </div>
                    <div class="column col-md-6">
                        <img class="img-fluid" src="{{ asset('images/landing-page/gantt.png') }}" alt="Not authorized page" style="border: 1px solid #eee; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" />
                    </div>
                </div>
            </div>

            <div class="container container-fluid not-authorize-feature">
                <div class="row flex-container row-droplist">
                    <div class="column col-md-6">
                        <img class="img-fluid" src="{{ asset('images/landing-page/report.png') }}" alt="Not authorized page" style="border: 1px solid #eee; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" />
                    </div>
                    <div class="column col-md-6 vertical-middle">
                        <div class="component component-heading">
                            <h2 class="ftask-title">
                                Report your progress to track project work progress
                            </h2>
                        </div>

                        <div class="sep">

                        </div>

                        <div class="component component-text">
                            <p class="ftask-text">Pie chart, ... to track your members' work progress from everywhere.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Not authorized-->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/calendar/fullcalendar.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>

@endsection
@section('page-script')
    {{-- Page js files --}}
    {{-- <script src="{{ asset(mix('js/scripts/charts/chart-task-overview.js')) }}"></script> --}}
    {{-- <script src="{{ asset(mix('js/scripts/pages/dashboard-calendar.js')) }}"></script> --}}
    <script src="{{ asset(mix('js/scripts/pages/app-calendar-events.js')) }}"></script>
@endsection
