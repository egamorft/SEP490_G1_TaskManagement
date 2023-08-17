@extends('layouts/contentLayoutMaster')

@section('title', 'Admin View - Account')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection

@section('content')
    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="img-fluid rounded mt-3 mb-2"
                                    src="{{ asset('images/avatars/' . $account->avatar) }}" height="110" width="110"
                                    alt="User avatar" />
                                <div class="user-info text-center">
                                    <h4>{{ $account->name }}</h4>
                                    <span
                                        class="badge bg-light-secondary">{{ $account->is_admin == 1 ? 'Admin' : 'User' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around my-2 pt-75">
                            <div class="d-flex align-items-start me-2">
                                <span class="badge bg-light-primary p-75 rounded">
                                    <i data-feather="check" class="font-medium-2"></i>
                                </span>
                                <div class="ms-75">
                                    <h4 class="mb-0">
                                        {{ $accountTasks->where('status', 3)->count() + $accountTasks->where('status', -1)->count() }}
                                    </h4>
                                    <small>Tasks Done</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <span class="badge bg-light-primary p-75 rounded">
                                    <i data-feather="briefcase" class="font-medium-2"></i>
                                </span>
                                <div class="ms-75">
                                    <h4 class="mb-0">568</h4>
                                    <small>Projects Done</small>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Email:</span>
                                    <span>{{ $account->email }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Status:</span>
                                    <span
                                        class="badge bg-light-{{ !$account->deleted_at ? 'success' : 'danger' }}">{{ !$account->deleted_at ? 'Active' : 'Inactive' }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Role:</span>
                                    <span>{{ $account->is_admin == 1 ? 'Admin' : 'User' }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Address:</span>
                                    <span>{{ $account->address }}</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center pt-2">
                                @if (!$account->deleted_at)
                                    <button data-bs-toggle="modal" data-bs-target="#suspendedUser{{ $account->id }}"
                                        type="button" class="btn btn-outline-danger waves-effect">Suspended</button>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#resumedUser{{ $account->id }}"
                                        type="button" class="btn btn-outline-success waves-effect">Resumed</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
                <!-- Plan Card -->
                <div class="card border-primary">
                    <!-- Support Tracker Chart Card starts -->
                    {{-- <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title">Tasks Tracker</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                    <h1 class="font-large-2 fw-bolder mt-2 mb-0">{{ $accountTasks->count() }}</h1>
                                    <p class="card-text">Tasks</p>
                                </div>
                                <div class="col-sm-10 col-12 d-flex justify-content-center">
                                    <div id="task-trackers-chart"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <div class="text-center">
                                    <p class="card-text mb-50">Done</p>
                                    <span
                                        class="font-large-1 fw-bold">{{ $accountTasks->where('status', 3)->count() }}</span>
                                </div>
                                <div class="text-center">
                                    <p class="card-text mb-50">Late</p>
                                    <span
                                        class="font-large-1 fw-bold">{{ $accountTasks->where('status', -1)->count() }}</span>
                                </div>
                                <div class="text-center">
                                    <p class="card-text mb-50">Doing</p>
                                    <span
                                        class="font-large-1 fw-bold">{{ $accountTasks->where('status', 1)->count() }}</span>
                                </div>
                                <div class="text-center">
                                    <p class="card-text mb-50">Reviewing</p>
                                    <span
                                        class="font-large-1 fw-bold">{{ $accountTasks->where('status', 2)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Support Tracker Chart Card ends -->
                </div>
                <!-- /Plan Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- User Pills -->
                <ul class="nav nav-pills mb-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.edit', $account->id) }}">
                            <i data-feather="user" class="font-medium-3 me-50"></i>
                            <span class="fw-bold">Account</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="">
                            <i data-feather="alert-triangle" class="font-medium-3 me-50"></i>
                            <span class="fw-bold">Report</span>
                        </a>
                    </li> --}}
                </ul>
                <!--/ User Pills -->

                <!-- Support Tracker Chart Card starts -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">Tasks Tracker</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                <h1 class="font-large-2 fw-bolder mt-2 mb-0">{{ $accountTasks->count() }}</h1>
                                <p class="card-text">Tasks</p>
                            </div>
                            <div class="col-sm-10 col-12 d-flex justify-content-center">
                                <div id="task-trackers-chart"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <div class="text-center">
                                <p class="card-text mb-50">Done</p>
                                <span class="font-large-1 fw-bold">{{ $accountTasks->where('status', 3)->count() }}</span>
                            </div>
                            <div class="text-center">
                                <p class="card-text mb-50">Late</p>
                                <span class="font-large-1 fw-bold">{{ $accountTasks->where('status', -1)->count() }}</span>
                            </div>
                            <div class="text-center">
                                <p class="card-text mb-50">Doing</p>
                                <span class="font-large-1 fw-bold">{{ $accountTasks->where('status', 1)->count() }}</span>
                            </div>
                            <div class="text-center">
                                <p class="card-text mb-50">Reviewing</p>
                                <span class="font-large-1 fw-bold">{{ $accountTasks->where('status', 2)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Support Tracker Chart Card ends -->


                <div class="card">
                    <div
                        class="
            card-header
            d-flex
            flex-sm-row flex-column
            justify-content-md-between
            align-items-start
            justify-content-start
          ">
                        <h4 class="card-title mb-sm-0 mb-1">Projects statistic</h4>
                    </div>
                    <div class="card-body">
                        <div id="radialbar-task-chart"></div>
                    </div>
                </div>
            </div>
            <!--/ User Content -->
        </div>
        <!-- Suspended Modal -->
        <div class="modal fade" id="suspendedUser{{ $account->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3 pt-0">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Suspended</h1>
                            <p>Suspended <strong>{{ $account->name }}</strong> per your requirements.</p>
                        </div>

                        <div class="alert alert-warning" role="alert">
                            <h6 class="alert-heading">Warning!</h6>
                            <div class="alert-body">
                                This suspension may affect ongoing projects
                            </div>
                        </div>

                        <form class="row" method="POST"
                            action="{{ route('destroy.user', ['id' => $account->id]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-primary">Suspended!!</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--/ Suspended Modal -->

        
        <!-- Resumed Modal -->
        <div class="modal fade" id="resumedUser{{ $account->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3 pt-0">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Resumed</h1>
                            <p>Resumed <strong>{{ $account->name }}</strong> per your requirements.</p>
                        </div>

                        <div class="alert alert-warning" role="alert">
                            <h6 class="alert-heading">Warning!</h6>
                            <div class="alert-body">
                                This suspension may affect ongoing projects
                            </div>
                        </div>

                        <form class="row" method="POST"
                            action="{{ route('destroy.user', ['id' => $account->id]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-primary">Resumed!!</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--/ Resumed Modal -->
    </section>

    @include('content/_partials/_modals/modal-edit-user')
    @include('content/_partials/_modals/modal-upgrade-plan')
@endsection
<script>
    var completePercentage = {{ $completePercentage }};
    var totalProject = {{ $projects->count() * 100 }};
    var totalReject = {{ $projects->where('project_status', -1)->count() / $projects->count() * 100 }};
    var totalApprove = {{ $projects->where('project_status', 2)->count() / $projects->count()  * 100 }};
</script>

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    {{-- data table --}}
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/charts/chart-apex.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-user-view-account.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-user-view.js')) }}"></script>
@endsection
