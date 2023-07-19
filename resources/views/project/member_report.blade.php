@extends('layouts/contentLayoutMaster')

@section('content')
    @include('project.header')
    @include('project.member_header')

    <!-- ChartJS section start -->
    <section id="chartjs-chart">

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

            <!-- Column Charts Starts-->
            <div class="col-xl-8 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title mb-75">Weekly progression</h4>
                    </div>
                    <div class="card-body">
                        <div id="chartContainer" style="height: 327px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <!-- Column Charts Ends-->
        </div>

        <div class="row">
            <!-- Project table -->
            <div class="card col-12">
                <h4 class="card-header">Tasks as Assignee</h4>
                <!-- Task Table -->
                <div class=" bg-white card-datatable table-responsive">
                    <table class="datatables-permissions table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Task List</th>
                                <th>Creator</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tasks = [1, 2, 3, 4, 5, 6];
                            @endphp
                            @foreach ($tasks as $task)
                                <tr id="task_{{ $task }}">
                                    <td>{{ $task }}</td>
                                    <td>{{ 'Task Name' }}</td>
                                    @switch($task)
                                        @case(1)
                                            <td>
                                                <span class="badge rounded-pill badge-light-primary">Doing</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-primary">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                            </td>
                                        @break

                                        @case(2)
                                            <td>
                                                <span class="badge rounded-pill badge-light-warning">Reviewing</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-warning">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                            </td>
                                        @break

                                        @case(3)
                                            <td>
                                                <span class="badge rounded-pill badge-light-success">Done Ontime</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-success">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                            </td>
                                        @break

                                        @case(4)
                                            <td>
                                                <span class="badge rounded-pill badge-light-secondary">Done Late</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-secondary">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                            </td>
                                        @break

                                        @case(5)
                                            <td>
                                                <span class="badge rounded-pill badge-light-danger">Overdue</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-danger">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                            </td>
                                        @break

                                        @default
                                            <td>
                                                <span class="badge rounded-pill badge-light-info">Todo</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill badge-light-info">{{ date('D, M d, Y', strtotime(12312323)) }}</span>
                                            </td>
                                    @endswitch
                                    <td>{{ 'Task List Name' }}</td>
                                    <td>
                                        <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}"
                                            data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
                                            title="{{ 'User Name' }}" class="avatar pull-up">
                                            <img src="{{ asset('images/avatars/H.png') }}" alt="Avatar" width="33"
                                                height="33" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--/ Task Table -->
            </div>
            <!-- /Project table -->

        </div>

    </section>
    <!-- ChartJS section end -->

    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "",
                    fontFamily: "Helvetica, Arial, sans-serif",
                    fontColor: "#6e6b7b !important"
                },
                axisX: {
                    interval: 1,
                    intervalType: "week"
                },
                axisY: {
                    valueFormatString: "# Tasks",
                    gridColor: "#6e6b7b",
                    tickColor: "#6e6b7b"
                },
                toolTip: {
                    shared: true,
                    content: toolTipContent
                },
                data: [{
                        type: "stackedColumn",
                        showInLegend: true,
                        color: "#00cfe8",
                        name: "Todo",
                        dataPoints: [{
                                y: 65,
                                x: new Date('07/01/2023')
                            },
                            {
                                y: 87,
                                x: new Date('07/08/2023')
                            },
                            {
                                y:  04,
                                x: new Date('07/15/2023')
                            },
                            {
                                y:  37,
                                x: new Date('07/22/2023')
                            },
                            {
                                y:  52,
                                x: new Date('07/29/2023')
                            },
                            {
                                y:  76,
                                x: new Date('08/05/2023')
                            },
                            {
                                y:  06,
                                x: new Date('08/12/2023')
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Doing",
                        color: "#7367f0",
                        dataPoints: [{
                                y: 65,
                                x: new Date('07/01/2023')
                            },
                            {
                                y: 87,
                                x: new Date('07/08/2023')
                            },
                            {
                                y:  04,
                                x: new Date('07/15/2023')
                            },
                            {
                                y:  37,
                                x: new Date('07/22/2023')
                            },
                            {
                                y:  52,
                                x: new Date('07/29/2023')
                            },
                            {
                                y:  76,
                                x: new Date('08/05/2023')
                            },
                            {
                                y:  06,
                                x: new Date('08/12/2023')
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Reviewing",
                        color: "#ff9f43",
                        dataPoints: [{
                                y: 65,
                                x: new Date('07/01/2023')
                            },
                            {
                                y: 87,
                                x: new Date('07/08/2023')
                            },
                            {
                                y:  04,
                                x: new Date('07/15/2023')
                            },
                            {
                                y:  37,
                                x: new Date('07/22/2023')
                            },
                            {
                                y:  52,
                                x: new Date('07/29/2023')
                            },
                            {
                                y:  76,
                                x: new Date('08/05/2023')
                            },
                            {
                                y:  06,
                                x: new Date('08/12/2023')
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Late",
                        color: "#82868b",
						dataPoints: [{
                                y: 65,
                                x: new Date('07/01/2023')
                            },
                            {
                                y: 87,
                                x: new Date('07/08/2023')
                            },
                            {
                                y:  04,
                                x: new Date('07/15/2023')
                            },
                            {
                                y:  37,
                                x: new Date('07/22/2023')
                            },
                            {
                                y:  52,
                                x: new Date('07/29/2023')
                            },
                            {
                                y:  76,
                                x: new Date('08/05/2023')
                            },
                            {
                                y:  06,
                                x: new Date('08/12/2023')
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Overdue",
                        color: "#ea5455",
                        dataPoints: [{
                                y: 65,
                                x: new Date('07/01/2023')
                            },
                            {
                                y: 87,
                                x: new Date('07/08/2023')
                            },
                            {
                                y:  04,
                                x: new Date('07/15/2023')
                            },
                            {
                                y:  37,
                                x: new Date('07/22/2023')
                            },
                            {
                                y:  52,
                                x: new Date('07/29/2023')
                            },
                            {
                                y:  76,
                                x: new Date('08/05/2023')
                            },
                            {
                                y:  06,
                                x: new Date('08/12/2023')
                            }
                        ]
                    }
                ]
            });
            chart.render();

            function toolTipContent(e) {
                var str = "";
                var total = 0;
                var str2, str3;
                for (var i = 0; i < e.entries.length; i++) {
                    var str1 = "<span style= \"color:" + e.entries[i].dataSeries.color + "\"> " + e.entries[i]
                        .dataSeries.name + "</span>: <strong>" + e.entries[i].dataPoint.y + "</strong> Tasks<br/>";
                    total = e.entries[i].dataPoint.y + total;
                    str = str.concat(str1);
                }
                str2 = "<span style = \"color:DodgerBlue;\"><strong>" + (e.entries[0].dataPoint.x).getFullYear() +
                    "</strong></span><br/>";
                total = Math.round(total * 100) / 100;
                str3 = "<hr/><span style = \"color:green\">Total:</span><strong> " + total + "</strong> Tasks<br/>";
                return (str2.concat(str)).concat(str3);
            }

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

    {{-- <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script> --}}
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/charts/chart-task-overview.js')) }}"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    {{-- <script src="{{ asset(mix('js/scripts/pages/task-overview-by-member.js')) }}"></script> --}}
@endsection
