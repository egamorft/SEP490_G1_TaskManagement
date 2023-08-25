@extends('layouts/contentLayoutMaster')

@section('content')
    @include('project.header')
    @include('project.member_header')

    <!-- ChartJS section start -->
    <section id="chartjs-chart">

        <div class="row">

            @if (count($tasks) > 0)
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
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="empty-state">
                            <i data-feather="database" class="empty-state-icon"></i>
                            <h3>
                                No data found
                            </h3>
                            <div>
                                Please work with your team member to be assigned to tasks.
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="row">
			@include('task.list-by-assignee')
			@include('task.modal')
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
                dd = String(new Date(task.due_date).getDate()).padStart(2, '0');
                mm = String(new Date(task.due_date).getMonth() + 1).padStart(2, '0');
                if (dd == day && mm == month) {
                    task_number++;
                }
            });
            todoData.push(task_number);

            task_number = 0;
            doingTasks.forEach(task => {
                dd = String(new Date(task.due_date).getDate()).padStart(2, '0');
                mm = String(new Date(task.due_date).getMonth() + 1).padStart(2, '0');
                if (dd == day && mm == month) {
                    task_number++;
                }
            });
            doingData.push(task_number);

            task_number = 0;
            reviewingTasks.forEach(task => {
                dd = String(new Date(task.due_date).getDate()).padStart(2, '0');
                mm = String(new Date(task.due_date).getMonth() + 1).padStart(2, '0');
                if (dd == day && mm == month) {
                    task_number++;
                }
            });
            reviewingData.push(task_number);

            task_number = 0;
            ontimeTasks.forEach(task => {
                dd = String(new Date(task.due_date).getDate()).padStart(2, '0');
                mm = String(new Date(task.due_date).getMonth() + 1).padStart(2, '0');
                if (dd == day && mm == month) {
                    task_number++;
                }
            });
            ontimeData.push(task_number);

            task_number = 0;
            lateTasks.forEach(task => {
                dd = String(new Date(task.due_date).getDate()).padStart(2, '0');
                mm = String(new Date(task.due_date).getMonth() + 1).padStart(2, '0');
                if (dd == day && mm == month) {
                    task_number++;
                }
            });
            lateData.push(task_number);

            task_number = 0;
            overdueTasks.forEach(task => {
                dd = String(new Date(task.due_date).getDate()).padStart(2, '0');
                mm = String(new Date(task.due_date).getMonth() + 1).padStart(2, '0');
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
	<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

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
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
	<script>
		var taskRoutes = "{{ route('view.task', ['slug' => $project->slug, 'task_id' => ':taskId']) }}";
	</script>
    <script src="{{ asset(mix('js/scripts/pages/task-detail.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/charts/chart-task-overview.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/task-list.js')) }}"></script>
    <script src="{{ asset('js/scripts/components/components-navs.js') }}"></script>
@endsection
