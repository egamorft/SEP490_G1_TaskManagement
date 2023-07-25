"use strict";

var TASK = new function () {

    var sidebar = $(".update-item-sidebar");
    var targetTaskModal = $('#targetTaskModal');


    //On click task
    this.showTaskDetail = function (task_id) {
        var url = "?show=task&task_id=" + task_id;
        var currentUrl = window.location.href.split(
            "?",
            window.location.href.length
        )[0];
        history.replaceState(null, null, window.location.pathname + url);
        currentUrl = window.location.href.substring(
            currentUrl.toString().length,
            window.location.href.toString().length
        );
        sidebar.modal("show");

        const urlParams = new URLSearchParams(window.location.search);
        const taskId = urlParams.get("task_id");

        var taskRoute = taskRoutes.replace(":taskId", taskId);
        const response = fetch(taskRoute);
        response
            .then((res) => {
                if (res.ok) {
                    return res.text();
                } else {
                    throw new Error("Network response was not ok");
                }
            })
            .then((html) => {
                targetTaskModal.find(".task-wrapper").html(html);
            })
            .catch((error) => {
                targetTaskModal.find(".task-wrapper").html(error);
            });
    };

    $(window).on("load", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const taskId = urlParams.get("task_id");
        if (taskId !== undefined && taskId !== null) {
            var taskRoute = taskRoutes.replace(":taskId", taskId);
            const response = fetch(taskRoute);
            response
                .then((res) => {
                    if (res.ok) {
                        return res.text();
                    } else {
                        throw new Error("Network response was not ok");
                    }
                })
                .then((html) => {
                    targetTaskModal.find(".task-wrapper").html(html);
                })
                .catch((error) => {
                    targetTaskModal.find(".task-wrapper").html(error);
                });
            sidebar.modal("show");
        }

        $(".btn-close").on("click", function () {
            var url = window.location.href.split(
                "?",
                window.location.href.toString().length
            )[0];
            history.replaceState(null, null, url);
        });
    });
};
