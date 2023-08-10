$(function () {
    "use strict";

    var chartColors = {
            todo: "#00cfe8",
            doing: "#7367f0",
            reviewing: "#ff9f43",
            ontime: "#28c76f",
            late: "#82868b",
            overdue: "#ea5455",
        },
        isRtl = $("html").attr("data-textdirection") === "rtl",
        flatPicker = $(".flat-picker");

    // Donut Chart
    // --------------------------------------------------------------------
    var donutChartEl = document.querySelector("#donut-chart"),
        donutChartConfig = {
            chart: {
                height: 400,
                type: "donut",
                events: {
                    click: function (event, chartContext, config) {
                        var html_status = $(event.target)
                            .parents("#donut-chart")
                            .find(
                                ".apexcharts-datalabels-group > text:first-child()"
                            )
                            .html();
						var data = {
							"todo": 0,
							"doing": 1,
							"reviewing": 2,
							"ontime": 3,
							"overdue": -1
						};

						html_status = html_status.toLowerCase();

						if(html_status.includes("done")) {
							html_status = html_status.substring(0, "done".length + 1);
						}

						var status = data[html_status] ?? 0;
						var table_task = $(event.target).parents('#chartjs-chart').find(".table-data-task .table-task");

						table_task.find("tbody tr").each(function(e) {
							var canvas = $(this);
							var data_id = canvas.attr("data-id");
							
							if (status == data_id) {
								return;
							}

							canvas.addClass("hidden");
						});
                    },
                },
            },
            legend: {
                show: true,
                position: "bottom",
            },
            labels: [
                "Todo",
                "Doing",
                "Reviewing",
                "Done Ontime",
                "Done Late",
                "Overdue",
            ],
            series: [
                todoTasks.length,
                doingTasks.length,
                reviewingTasks.length,
                ontimeTasks.length,
                lateTasks.length,
                overdueTasks.length,
            ],
            colors: [
                chartColors.todo,
                chartColors.doing,
                chartColors.reviewing,
                chartColors.ontime,
                chartColors.late,
                chartColors.overdue,
            ],
            dataLabels: {
                enabled: true,
                formatter: function (val, opt) {
                    return parseInt(val) + "%";
                },
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                fontSize: "2rem",
                                fontFamily: "Montserrat",
                            },
                            value: {
                                fontSize: "1rem",
                                fontFamily: "Montserrat",
                                formatter: function (val) {
                                    return parseInt(val) + "%";
                                },
                            },
                            total: {
                                show: true,
                                fontSize: "1.5rem",
                                label: "Total Tasks",
                                formatter: function (w) {
                                    return "100%";
                                },
                            },
                        },
                    },
                },
            },
            responsive: [
                {
                    breakpoint: 992,
                    options: {
                        chart: {
                            height: 380,
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 320,
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: true,
                                        name: {
                                            fontSize: "1.5rem",
                                        },
                                        value: {
                                            fontSize: "1rem",
                                        },
                                        total: {
                                            fontSize: "1.5rem",
                                        },
                                    },
                                },
                            },
                        },
                    },
                },
            ],
        };
    if (typeof donutChartEl !== undefined && donutChartEl !== null) {
        var donutChart = new ApexCharts(donutChartEl, donutChartConfig);
        donutChart.render();
    }

    // Init flatpicker
    if (flatPicker.length) {
        var date = new Date();
        flatPicker.each(function () {
            $(this).flatpickr({
                mode: "range",
                defaultDate: ["2019-05-01", "2019-05-10"],
            });
        });
    }

    // Area Chart
    // --------------------------------------------------------------------
    var areaChartEl = document.querySelector("#line-area-chart"),
        areaChartConfig = {
            chart: {
                height: 370,
                type: "area",
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: false,
                curve: "straight",
            },
            legend: {
                show: true,
                position: "top",
                horizontalAlign: "start",
            },
            grid: {
                xaxis: {
                    lines: {
                        show: true,
                    },
                },
            },
            colors: [
                chartColors.todo,
                chartColors.doing,
                chartColors.reviewing,
                chartColors.ontime,
                chartColors.late,
                chartColors.overdue,
            ],
            series: [
                {
                    name: "Todo",
                    data: todoData,
                },
                {
                    name: "Doing",
                    data: doingData,
                },
                {
                    name: "Reviewing",
                    data: reviewingData,
                },
                {
                    name: "Done Ontime",
                    data: ontimeData,
                },
                {
                    name: "Done Late",
                    data: lateData,
                },
                {
                    name: "Overdue",
                    data: overdueData,
                },
            ],
            xaxis: {
                categories: dates,
            },
            fill: {
                opacity: 1,
                type: "solid",
            },
            tooltip: {
                shared: false,
            },
            yaxis: {
                opposite: isRtl,
            },
        };
    if (typeof areaChartEl !== undefined && areaChartEl !== null) {
        var areaChart = new ApexCharts(areaChartEl, areaChartConfig);
        areaChart.render();
    }
});
