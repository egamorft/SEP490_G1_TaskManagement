$(function () {
    "use strict";

    var chartColors = {
				todo: "#00cfe8",
                doing: "#7367f0",
                reviewing: "#ff9f43",
                ontime: "#28c76f",
                late: "#82868b",
                overdue: "#ea5455",
        };

    // Donut Chart
    // --------------------------------------------------------------------
    var donutChartEl = document.querySelector("#donut-chart"),
        donutChartConfig = {
            chart: {
                height: 350,
                type: "donut",
            },
            legend: {
                show: true,
                position: "bottom",
            },
            labels: ["Todo", "Doing", "Reviewing", "Done Ontime", "Done Late", "Overdue"],
            series: [10, 20, 30, 10, 20, 10],
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
                                label: "Operational",
                                formatter: function (w) {
                                    return "31%";
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
});
