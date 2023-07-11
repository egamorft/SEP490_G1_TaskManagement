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
                                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="avatar me-1"><img src="//localhost:3000/images/avatars/1.png"
                                                    alt="Project Image" width="32" class="rounded-circle"></a>
                                        </div>
                                        <div class="d-flex flex-column"><a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="text-truncate fw-bolder">Tran Ngoc
                                                Hieu</a><small class="text-muted">Project Manager</small></div>
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
                            <tr class="even">
                                <td class=" control" tabindex="0" style="display: none;"></td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="avatar me-1"><img src="//localhost:3000/images/avatars/2.png"
                                                    alt="Project Image" width="32" class="rounded-circle"></a>
                                        </div>
                                        <div class="d-flex flex-column"><a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="text-truncate fw-bolder">Tran Ngoc
                                                Hieu</a><small class="text-muted">Project Supervisor</small></div>
                                    </div>
                                </td>
                                <td>90</td>
                                <td class="text-info">12</td>
                                <td class="text-primary">11</td>
                                <td class="text-warning">12</td>
                                <td class="text-success">4</td>
                                <td class="text-secondary">21</td>
                                <td class="text-danger">13</td>
                            </tr>
                            <tr class="odd">
                                <td class=" control" tabindex="0" style="display: none;"></td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="avatar me-1"><img src="//localhost:3000/images/avatars/3.png"
                                                    alt="Project Image" width="32" class="rounded-circle"></a>
                                        </div>
                                        <div class="d-flex flex-column"><a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="text-truncate fw-bolder">Tran Ngoc
                                                Hieu</a><small class="text-muted">Project Member</small></div>
                                    </div>
                                </td>
                                <td>90</td>
                                <td class="text-info">51</td>
                                <td class="text-primary">1</td>
                                <td class="text-warning">14</td>
                                <td class="text-success">1</td>
                                <td class="text-secondary">51</td>
                                <td class="text-danger">6</td>
                            </tr>
                            <tr class="even">
                                <td class=" control" tabindex="0" style="display: none;"></td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="avatar me-1"><img src="//localhost:3000/images/avatars/4.png"
                                                    alt="Project Image" width="32" class="rounded-circle"></a>
                                        </div>
                                        <div class="d-flex flex-column"><a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="text-truncate fw-bolder">Tran Ngoc
                                                Hiep</a><small class="text-muted">Project Member</small></div>
                                    </div>
                                </td>
                                <td>16</td>
                                <td class="text-info">1</td>
                                <td class="text-primary">61</td>
                                <td class="text-warning">1</td>
                                <td class="text-success">91</td>
                                <td class="text-secondary">1</td>
                                <td class="text-danger">1</td>
                            </tr>
                            <tr class="odd">
                                <td class=" control" tabindex="0" style="display: none;"></td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="avatar me-1"><img src="//localhost:3000/images/avatars/4.png"
                                                    alt="Project Image" width="32" class="rounded-circle"></a>
                                        </div>
                                        <div class="d-flex flex-column"><a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="text-truncate fw-bolder">DTran Ngoc
                                                Hieu</a><small class="text-muted">Project Member</small></div>
                                    </div>
                                </td>
                                <td>278</td>
                                <td class="text-info">1</td>
                                <td class="text-primary">1</td>
                                <td class="text-warning">1</td>
                                <td class="text-success">1</td>
                                <td class="text-secondary">1</td>
                                <td class="text-danger">1</td>
                            </tr>
                            <tr class="even">
                                <td class=" control" tabindex="0" style="display: none;"></td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="avatar me-1"><img src="//localhost:3000/images/avatars/6.png"
                                                    alt="Project Image" width="32" class="rounded-circle"></a>
                                        </div>
                                        <div class="d-flex flex-column"><a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="text-truncate fw-bolder">Tran Ngoc
                                                Hieue</a><small class="text-muted">Project Member</small></div>
                                    </div>
                                </td>
                                <td>27</td>
                                <td class="text-info">1</td>
                                <td class="text-primary">1</td>
                                <td class="text-warning">1</td>
                                <td class="text-success">1</td>
                                <td class="text-secondary">1</td>
                                <td class="text-danger">1</td>
                            </tr>
                            <tr class="odd">
                                <td class=" control" tabindex="0" style="display: none;"></td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                            <a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="avatar me-1"><img src="//localhost:3000/images/avatars/H.png"
                                                    alt="Project Image" width="32" class="rounded-circle"></a>
                                        </div>
                                        <div class="d-flex flex-column"><a href="{{ route('view.project.member', ['slug' => $project->slug, 'user_id' => 0]) }}" class="text-truncate fw-bolder">VTran Ngoc
                                                Hieute</a><small class="text-muted">Project Member</small></div>
                                    </div>
                                </td>
                                <td>217</td>
                                <td class="text-info">1</td>
                                <td class="text-primary">1</td>
                                <td class="text-warning">1</td>
                                <td class="text-success">1</td>
                                <td class="text-secondary">1</td>
                                <td class="text-danger">1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
                    intervalType: "month"
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
                                y: 6.75,
                                x: new Date(2023, 01, 01)
                            },
                            {
                                y: 8.57,
                                x: new Date(2023, 02, 01)
                            },
                            {
                                y: 10.64,
                                x: new Date(2023, 03, 01)
                            },
                            {
                                y: 13.97,
                                x: new Date(2023, 04, 01)
                            },
                            {
                                y: 15.42,
                                x: new Date(2023, 05, 01)
                            },
                            {
                                y: 17.26,
                                x: new Date(2023, 06, 01)
                            },
                            {
                                y: 20.26,
                                x: new Date(2023, 06, 01)
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Doing",
                        color: "#7367f0",
                        dataPoints: [{
                                y: 6.82,
                                x: new Date(2023, 01, 01)
                            },
                            {
                                y: 9.02,
                                x: new Date(2023, 02, 01)
                            },
                            {
                                y: 11.80,
                                x: new Date(2023, 03, 01)
                            },
                            {
                                y: 14.11,
                                x: new Date(2023, 04, 01)
                            },
                            {
                                y: 15.96,
                                x: new Date(2023, 05, 01)
                            },
                            {
                                y: 17.73,
                                x: new Date(2023, 06, 01)
                            },
                            {
                                y: 21.5,
                                x: new Date(2023, 06, 01)
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Reviewing",
                        color: "#ff9f43",
                        dataPoints: [{
                                y: 7.28,
                                x: new Date(2023, 01, 01)
                            },
                            {
                                y: 9.72,
                                x: new Date(2023, 02, 01)
                            },
                            {
                                y: 13.30,
                                x: new Date(2023, 03, 01)
                            },
                            {
                                y: 14.9,
                                x: new Date(2023, 04, 01)
                            },
                            {
                                y: 18.10,
                                x: new Date(2023, 05, 01)
                            },
                            {
                                y: 18.68,
                                x: new Date(2023, 06, 01)
                            },
                            {
                                y: 22.45,
                                x: new Date(2023, 06, 01)
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Ontime",
                        color: "#28c76f",
                        dataPoints: [{
                                y: 8.44,
                                x: new Date(2023, 01, 01)
                            },
                            {
                                y: 10.58,
                                x: new Date(2023, 02, 01)
                            },
                            {
                                y: 14.41,
                                x: new Date(2023, 03, 01)
                            },
                            {
                                y: 16.86,
                                x: new Date(2023, 04, 01)
                            },
                            {
                                y: 10.64,
                                x: new Date(2023, 05, 01)
                            },
                            {
                                y: 21.32,
                                x: new Date(2023, 06, 01)
                            },
                            {
                                y: 26.06,
                                x: new Date(2023, 06, 01)
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Late",
                        color: "#82868b",
                        dataPoints: [{
                                y: 8.44,
                                x: new Date(2023, 01, 01)
                            },
                            {
                                y: 10.58,
                                x: new Date(2023, 02, 01)
                            },
                            {
                                y: 14.41,
                                x: new Date(2023, 03, 01)
                            },
                            {
                                y: 16.86,
                                x: new Date(2023, 04, 01)
                            },
                            {
                                y: 10.64,
                                x: new Date(2023, 05, 01)
                            },
                            {
                                y: 21.32,
                                x: new Date(2023, 06, 01)
                            },
                            {
                                y: 26.06,
                                x: new Date(2023, 06, 01)
                            }
                        ]
                    },
                    {
                        type: "stackedColumn",
                        showInLegend: true,
                        name: "Overdue",
                        color: "#ea5455",
                        dataPoints: [{
                                y: 8.44,
                                x: new Date(2023, 01, 01)
                            },
                            {
                                y: 10.58,
                                x: new Date(2023, 02, 01)
                            },
                            {
                                y: 14.41,
                                x: new Date(2023, 03, 01)
                            },
                            {
                                y: 16.86,
                                x: new Date(2023, 04, 01)
                            },
                            {
                                y: 10.64,
                                x: new Date(2023, 05, 01)
                            },
                            {
                                y: 21.32,
                                x: new Date(2023, 06, 01)
                            },
                            {
                                y: 26.06,
                                x: new Date(2023, 06, 01)
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
                        .dataSeries.name + "</span>: $<strong>" + e.entries[i].dataPoint.y + "</strong>bn<br/>";
                    total = e.entries[i].dataPoint.y + total;
                    str = str.concat(str1);
                }
                str2 = "<span style = \"color:DodgerBlue;\"><strong>" + (e.entries[0].dataPoint.x).getFullYear() +
                    "</strong></span><br/>";
                total = Math.round(total * 100) / 100;
                str3 = "<span style = \"color:Tomato\">Total:</span><strong> $" + total + "</strong>bn<br/>";
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
