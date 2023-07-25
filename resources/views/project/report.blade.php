@extends('layouts/contentLayoutMaster')

@section('content')
    @include('project.header')

    <!-- ChartJS section start -->
    <section id="chartjs-chart" class="{{ $disabledProject ? 'opacity-50 pointer-events-none' : '' }}">

        <div class="row">
            <!-- Donut Chart Starts-->
            <div class="col-xl-4 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title mb-75">Task Overview</h4>
                        <span class="card-subtitle text-muted">Task breakdown by statuses </span>
                    </div>
                    <div class="card-body">
                        <div id="donut-chart"></div>
                    </div>
                </div>
            </div>
            <!-- Donut Chart Ends-->

            <!-- Area Chart starts -->
            <div class="col-xl-8 col-12">
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
                        <div>
                            <h4 class="card-title">All Task</h4>
                            <span class="card-subtitle text-muted">Commercial networks</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="font-medium-2" data-feather="calendar"></i>
                            <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="line-area-chart"></div>
                    </div>
                </div>
            </div>
            <!-- Area Chart ends -->

        </div>

        <div class="row">
            <!-- Project table -->
            <div class="card col-12">
                <h4 class="card-header">Task assignments by members</h4>
                <div class="table-responsive">
                    <table class="table datatable-project">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th class="text-nowrap">Total Task</th>
                                <th>Todo</th>
                                <th>Doing</th>
                                <th>Reviewing</th>
                                <th>Ontime</th>
                                <th>Late</th>
                                <th>Overdue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd">
                                <td class=" control" tabindex="0" style="display: none;"></td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => $pmAccount->id]) }}"
                                                class="avatar me-1"><img
                                                    src="{{ asset('images/avatars/' . $pmAccount->avatar) }}"
                                                    alt="Project Image" width="32" class="rounded-circle"></a>
                                        </div>
                                        <div class="d-flex flex-column"><a
                                                href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => $pmAccount->id]) }}"
                                                class="text-truncate fw-bolder">{{ $pmAccount->fullname ?? '' }}</a>
                                            <small class="text-muted">Project Manager</small>
                                        </div>
                                    </div>
                                </td>
                                <td>120</td>
                                <td class="text-info">1</td>
                                <td class="text-primary">1</td>
                                <td class="text-warning">1</td>
                                <td class="text-success">1</td>
                                <td class="text-secondary">1</td>
                                <td class="text-danger">1</td>
                            </tr>
                            @if ($supervisorAccount)
                                <tr class="odd">
                                    <td class=" control" tabindex="0" style="display: none;"></td>
                                    <td>
                                        <div class="d-flex justify-content-left align-items-center">
                                            <div class="avatar-wrapper">
                                                <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => $supervisorAccount->id]) }}"
                                                    class="avatar me-1"><img
                                                        src="{{ asset('images/avatars/' . $supervisorAccount->avatar) }}"
                                                        alt="Project Image" width="32" class="rounded-circle"></a>
                                            </div>
                                            <div class="d-flex flex-column"><a
                                                    href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => $supervisorAccount->id]) }}"
                                                    class="text-truncate fw-bolder">{{ $supervisorAccount->fullname ?? '' }}</a>
                                                <small class="text-muted">Project Supervisor</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>120</td>
                                    <td class="text-info">1</td>
                                    <td class="text-primary">1</td>
                                    <td class="text-warning">1</td>
                                    <td class="text-success">1</td>
                                    <td class="text-secondary">1</td>
                                    <td class="text-danger">1</td>
                                </tr>
                            @endif
                            @foreach ($memberAccount as $acc)
                                <tr class="odd">
                                    <td class=" control" tabindex="0" style="display: none;"></td>
                                    <td>
                                        <div class="d-flex justify-content-left align-items-center">
                                            <div class="avatar-wrapper">
                                                <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => $acc->id]) }}"
                                                    class="avatar me-1"><img
                                                        src="{{ asset('images/avatars/' . $acc->avatar) }}"
                                                        alt="Project Image" width="32" class="rounded-circle"></a>
                                            </div>
                                            <div class="d-flex flex-column"><a
                                                    href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => $acc->id]) }}"
                                                    class="text-truncate fw-bolder">{{ $acc->fullname ?? '' }}</a>
                                                <small class="text-muted">Project Member</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>120</td>
                                    <td class="text-info">1</td>
                                    <td class="text-primary">1</td>
                                    <td class="text-warning">1</td>
                                    <td class="text-success">1</td>
                                    <td class="text-secondary">1</td>
                                    <td class="text-danger">1</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /Project table -->

        </div>

    </section>
    <!-- ChartJS section end -->

    <script>
        var boards = @json($boards),
            tasks = @json($tasks),
            todoTasks = @json($todoTasks),
            doingTasks = @json($doingTasks),
            reviewingTasks = @json($reviewingTasks),
            ontimeTasks = @json($ontimeTasks),
            lateTasks = @json($lateTasks),
            overdueTasks = @json($overdueTasks);

        var todoData = [],
            doingData = [],
            reviewingData = [],
            ontimeData = [],
            lateData = [],
            overdueData = [];

        todoTasks.forEach(task => {
            todoData.push({
                y: 1,
                x: new Date(task.created_at)
            });
        });
        doingTasks.forEach(task => {
            doingData.push({
                y: 1,
                x: new Date(task.created_at)
            });
        });
        reviewingTasks.forEach(task => {
            reviewingData.push({
                y: 1,
                x: new Date(task.created_at)
            });
        });
        ontimeTasks.forEach(task => {
            ontimeData.push({
                y: 1,
                x: new Date(task.created_at)
            });
        });
        lateTasks.forEach(task => {
            lateData.push({
                y: 1,
                x: new Date(task.created_at)
            });
        });
        overdueTasks.forEach(task => {
            overdueData.push({
                y: 1,
                x: new Date(task.created_at)
            });
        });

        console.log(todoData);
    </script>
@endsection

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/charts/chart-task-overview.js')) }}"></script>
@endsection
