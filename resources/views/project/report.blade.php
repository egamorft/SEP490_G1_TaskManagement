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
                            <span class="card-subtitle text-muted">Group task by day</span>
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
            <div class="card col-12 card-table">
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
                                                class="text-truncate fw-bolder">{{ $pmAccount->name ?? '' }}</a>
                                            <small class="text-muted">Project Manager</small>
                                        </div>
                                    </div>
                                </td>
                                @php
                                    $todoNum = 0;
                                    $doingNum = 0;
                                    $reviewingNum = 0;
                                    $ontimeNum = 0;
                                    $lateNum = 0;
                                    $overdueNum = 0;
                                    foreach ($todoTasks as $task) {
                                        if ($task->assign_to == $pmAccount->id) {
                                            $todoNum++;
                                        }
                                    }
                                    foreach ($doingTasks as $task) {
                                        if ($task->assign_to == $pmAccount->id) {
                                            $doingNum++;
                                        }
                                    }
                                    foreach ($reviewingTasks as $task) {
                                        if ($task->assign_to == $pmAccount->id) {
                                            $reviewingNum++;
                                        }
                                    }
                                    foreach ($ontimeTasks as $task) {
                                        if ($task->assign_to == $pmAccount->id) {
                                            $ontimeNum++;
                                        }
                                    }
                                    foreach ($lateTasks as $task) {
                                        if ($task->assign_to == $pmAccount->id) {
                                            $lateNum++;
                                        }
                                    }
                                    foreach ($overdueTasks as $task) {
                                        if ($task->assign_to == $pmAccount->id) {
                                            $overdueNum++;
                                        }
                                    }
                                @endphp
                                <td>{{ $todoNum + $doingNum + $reviewingNum + $ontimeNum + $lateNum + $overdueNum }}</td>
                                <td class="text-info">{{ $todoNum }}</td>
                                <td class="text-primary">{{ $doingNum }}</td>
                                <td class="text-warning">{{ $reviewingNum }}</td>
                                <td class="text-success">{{ $ontimeNum }}</td>
                                <td class="text-secondary">{{ $lateNum }}</td>
                                <td class="text-danger">{{ $overdueNum }}</td>
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
                                                    class="text-truncate fw-bolder">{{ $supervisorAccount->name ?? '' }}</a>
                                                <small class="text-muted">Project Supervisor</small>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                        $todoNum = 0;
                                        $doingNum = 0;
                                        $reviewingNum = 0;
                                        $ontimeNum = 0;
                                        $lateNum = 0;
                                        $overdueNum = 0;
                                        foreach ($todoTasks as $task) {
                                            if ($task->assign_to == $supervisorAccount->id) {
                                                $todoNum++;
                                            }
                                        }
                                        foreach ($doingTasks as $task) {
                                            if ($task->assign_to == $supervisorAccount->id) {
                                                $doingNum++;
                                            }
                                        }
                                        foreach ($reviewingTasks as $task) {
                                            if ($task->assign_to == $supervisorAccount->id) {
                                                $reviewingNum++;
                                            }
                                        }
                                        foreach ($ontimeTasks as $task) {
                                            if ($task->assign_to == $supervisorAccount->id) {
                                                $ontimeNum++;
                                            }
                                        }
                                        foreach ($lateTasks as $task) {
                                            if ($task->assign_to == $supervisorAccount->id) {
                                                $lateNum++;
                                            }
                                        }
                                        foreach ($overdueTasks as $task) {
                                            if ($task->assign_to == $supervisorAccount->id) {
                                                $overdueNum++;
                                            }
                                        }
                                    @endphp
                                    <td>{{ $todoNum + $doingNum + $reviewingNum + $ontimeNum + $lateNum + $overdueNum }}
                                    </td>
                                    <td class="text-info">{{ $todoNum }}</td>
                                    <td class="text-primary">{{ $doingNum }}</td>
                                    <td class="text-warning">{{ $reviewingNum }}</td>
                                    <td class="text-success">{{ $ontimeNum }}</td>
                                    <td class="text-secondary">{{ $lateNum }}</td>
                                    <td class="text-danger">{{ $overdueNum }}</td>
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
                                                    class="text-truncate fw-bolder">{{ $acc->name ?? '' }}</a>
                                                <small class="text-muted">Project Member</small>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                        $todoNum = 0;
                                        $doingNum = 0;
                                        $reviewingNum = 0;
                                        $ontimeNum = 0;
                                        $lateNum = 0;
                                        $overdueNum = 0;
                                        foreach ($todoTasks as $task) {
                                            if ($task->assign_to == $acc->id) {
                                                $todoNum++;
                                            }
                                        }
                                        foreach ($doingTasks as $task) {
                                            if ($task->assign_to == $acc->id) {
                                                $doingNum++;
                                            }
                                        }
                                        foreach ($reviewingTasks as $task) {
                                            if ($task->assign_to == $acc->id) {
                                                $reviewingNum++;
                                            }
                                        }
                                        foreach ($ontimeTasks as $task) {
                                            if ($task->assign_to == $acc->id) {
                                                $ontimeNum++;
                                            }
                                        }
                                        foreach ($lateTasks as $task) {
                                            if ($task->assign_to == $acc->id) {
                                                $lateNum++;
                                            }
                                        }
                                        foreach ($overdueTasks as $task) {
                                            if ($task->assign_to == $acc->id) {
                                                $overdueNum++;
                                            }
                                        }
                                    @endphp
                                    <td>{{ $todoNum + $doingNum + $reviewingNum + $ontimeNum + $lateNum + $overdueNum }}
                                    </td>
                                    <td class="text-info">{{ $todoNum }}</td>
                                    <td class="text-primary">{{ $doingNum }}</td>
                                    <td class="text-warning">{{ $reviewingNum }}</td>
                                    <td class="text-success">{{ $ontimeNum }}</td>
                                    <td class="text-secondary">{{ $lateNum }}</td>
                                    <td class="text-danger">{{ $overdueNum }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /Project table -->
            <div class="card table-data-task card-table">
                <div class="card-body border-bottom mb-0">
                    <h4 class="card-title mb-0">Task Overview</h4>
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table class="table datatable-project project-list-table table-task">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Creator/Reviewer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $key => $task)
                                @php
                                    $creator = null;
                                    foreach ($memberAccount as $acc) {
                                        if ($acc->id == $task->created_by) {
                                            $creator = $acc;
                                        }
                                    }
                                    if ($supervisorAccount) {
                                        if ($supervisorAccount->id == $task->created_by) {
                                            $creator = $supervisorAccount;
                                        }
                                    }
                                    if ($pmAccount->id == $task->created_by) {
                                        $creator = $pmAccount;
                                    }
                                @endphp
                                <tr class="odd" id="row{{ $task->id }}" data-status='{{ $task->status }}'
                                    data-time='{{ $task->due_date }}'>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="d-flex justify-content-left align-items-center">
                                            <div class="more-info">
                                                <h6 class="mb-0 text-truncate" style="max-width: 300px; display: block;">
                                                    <a
                                                        onclick="TASK.showTaskDetail({{ $task->id }}, '{{ $task->project->slug }}', {{ $task->board->id }})">{{ $task->title }}</a>
                                                </h6>
                                                <small class="text-truncate"
                                                    style="max-width: 300px; display: block;">{{ $task->description ? $task->description : 'No Description' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    @switch($task->status)
                                        @case(1)
                                            @php
                                                $task_due_date = strtotime($task->due_date);
                                                $today = time();
                                            @endphp
                                            @if ($task_due_date < $today)
                                                <td>
                                                    <span class="badge rounded-pill badge-light-danger">Overdue</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill badge-light-danger">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : 'No Info' }}</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge rounded-pill badge-light-primary">Doing</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill badge-light-primary">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : 'No Info' }}</span>
                                                </td>
                                            @endif
                                        @break

                                        @case(2)
                                            <td>
                                                <span class="badge rounded-pill badge-light-warning">Reviewing</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-warning">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : 'No Info' }}</span>
                                            </td>
                                        @break

                                        @case(3)
                                            <td>
                                                <span class="badge rounded-pill badge-light-success">Done Ontime</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-success">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : 'No Info' }}</span>
                                            </td>
                                        @break

                                        @case(-1)
                                            <td>
                                                <span class="badge rounded-pill badge-light-secondary">Done Late</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-secondary">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : 'No Info' }}</span>
                                            </td>
                                        @break

                                        @case(5)
                                            <td>
                                                <span class="badge rounded-pill badge-light-danger">Overdue</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-danger">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : 'No Info' }}</span>
                                            </td>
                                        @break

                                        @default
                                            @php
                                                $task_due_date = strtotime($task->due_date);
                                                $today = time();
                                            @endphp
                                            @if ($task_due_date < $today)
                                                <td>
                                                    <span class="badge rounded-pill badge-light-danger">Overdue</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill badge-light-danger">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : 'No Info' }}</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge rounded-pill badge-light-info">Todo</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill badge-light-info">{{ $task->due_date ? date('D, M d, Y', strtotime($task->due_date)) : 'No Info' }}</span>
                                                </td>
                                            @endif
                                    @endswitch
                                    <td>
                                        <div class="avatar float-start bg-white rounded">
                                            <a href="{{ '#' }}"
                                                class="avatar float-start bg-white rounded me-1">
                                                <img src="{{ asset('images/avatars/' . $task->reviewer->avatar) }}"
                                                    alt="Avatar" width="33" height="33" />
                                            </a>
                                        </div>
                                        <div class="more-info pt-05">
                                            <h6 class="mt-0">{{ $task->reviewer->name ?? '' }}</h6>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            No data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


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

            var dayByWeek = [];
            // Project Info
            var project = @json($project);
            var today = new Date();
            var start = new Date(project.start_date);
            var end = new Date(project.end_date);

            var todoData = [],
                doingData = [],
                reviewingData = [],
                ontimeData = [],
                lateData = [],
                overdueData = [];
            var dates = [];
            var current = start;
            while (current <= end) {
                var day = String(current.getDate()).padStart(2, '0');
                var month = String(current.getMonth() + 1).padStart(2, '0');
                var dd = '',
                    mm = '';
                var task_number = 0;
                dates.push(`${day}/${month}`);
                current.setDate(current.getDate() + 1);

                task_number = 0;
                todoTasks.forEach(task => {
                    dd = String(new Date(task.created_at).getDate()).padStart(2, '0');
                    mm = String(new Date(task.created_at).getMonth() + 1).padStart(2, '0');
                    if (dd == day && mm == month) {
                        task_number++;
                    }
                });
                todoData.push(task_number);

                task_number = 0;
                doingTasks.forEach(task => {
                    dd = String(new Date(task.created_at).getDate()).padStart(2, '0');
                    mm = String(new Date(task.created_at).getMonth() + 1).padStart(2, '0');
                    if (dd == day && mm == month) {
                        task_number++;
                    }
                });
                doingData.push(task_number);

                task_number = 0;
                reviewingTasks.forEach(task => {
                    dd = String(new Date(task.created_at).getDate()).padStart(2, '0');
                    mm = String(new Date(task.created_at).getMonth() + 1).padStart(2, '0');
                    if (dd == day && mm == month) {
                        task_number++;
                    }
                });
                reviewingData.push(task_number);

                task_number = 0;
                ontimeTasks.forEach(task => {
                    dd = String(new Date(task.created_at).getDate()).padStart(2, '0');
                    mm = String(new Date(task.created_at).getMonth() + 1).padStart(2, '0');
                    if (dd == day && mm == month) {
                        task_number++;
                    }
                });
                ontimeData.push(task_number);

                task_number = 0;
                lateTasks.forEach(task => {
                    dd = String(new Date(task.created_at).getDate()).padStart(2, '0');
                    mm = String(new Date(task.created_at).getMonth() + 1).padStart(2, '0');
                    if (dd == day && mm == month) {
                        task_number++;
                    }
                });
                lateData.push(task_number);

                task_number = 0;
                overdueTasks.forEach(task => {
                    dd = String(new Date(task.created_at).getDate()).padStart(2, '0');
                    mm = String(new Date(task.created_at).getMonth() + 1).padStart(2, '0');
                    if (dd == day && mm == month) {
                        task_number++;
                    }
                });
                overdueData.push(task_number);
            }
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
