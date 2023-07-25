$(function () {
    "use strict";

    var chartColors = {
        todo: "#00cfe8",
        doing: "#7367f0",
        reviewing: "#ff9f43",
        ontime: "#28c76f",
        late: "#82868b",
        overdue: "#ea5455",
		area: {
			series3: '#a4f8cd',
			series2: '#60f2ca',
			series1: '#2bdac7'
		  }
    },
	isRtl = $('html').attr('data-textdirection') === 'rtl',
	flatPicker = $('.flat-picker');

    // Donut Chart
    // --------------------------------------------------------------------
    var donutChartEl = document.querySelector("#donut-chart"),
        donutChartConfig = {
            chart: {
                height: 400,
                type: "donut",
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
			mode: 'range',
			defaultDate: ['2019-05-01', '2019-05-10']
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
                chartColors.area.series3,
                chartColors.area.series2,
                chartColors.area.series1,
            ],
            series: [
                {
                    name: "Visits",
                    data: [
                        100, 120, 90, 170, 130, 160, 140, 240, 220, 180, 270,
                        280, 375,
                    ],
                },
                {
                    name: "Clicks",
                    data: [
                        60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220,
                        275,
                    ],
                },
                {
                    name: "Sales",
                    data: [
                        20, 40, 30, 70, 40, 60, 50, 140, 120, 100, 140, 180,
                        220,
                    ],
                },
            ],
            xaxis: {
                categories: [
                    "7/12",
                    "8/12",
                    "9/12",
                    "10/12",
                    "11/12",
                    "12/12",
                    "13/12",
                    "14/12",
                    "15/12",
                    "16/12",
                    "17/12",
                    "18/12",
                    "19/12",
                    "20/12",
                ],
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
