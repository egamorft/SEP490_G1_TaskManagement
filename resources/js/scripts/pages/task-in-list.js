/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 **/

"use-strict";

const modalCalendarTask = $("#modalCalendarTask");
const targetTaskModal = $('#targetTaskModal');

document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar"),
        calendarsColor = {
            Todo: "info",
            Doing: "primary",
            Reviewing: "warning",
            Done: "success",
            Late: "secondary",
            Overdue: "danger",
        },
        filterStatus = {
            0: "todo",
            1: "doing",
            2: "reviewing",
            3: "ontime",
            100: "late",
            1000: "overdue",
        };
    (selectAll = $(".select-all")),
        (calEventFilter = $(".calendar-events-filter")),
        (filterInput = $(".input-filter"));

    // --------------------------------------------
    $("#select-all").on("change", function () {
        var is_checked = $(this).attr("checked");
        if (typeof is_checked !== "undefined" && is_checked !== false) {
            $(".input-filter:checked").each(function () {
                $(this).prop("checked", false);
            });
            $(this).attr("checked", false);
        } else {
            $(".input-filter").each(function () {
                $(this).prop("checked", true);
            });
            $(this).attr("checked", true);
        }
        fetchEvents();
    });

    if (filterInput.length) {
        filterInput.on("change", function () {
            if ($(".input-filter:checked").length < 6) {
                $("#select-all").attr("checked", false);
            }
            $(".input-filter:checked").length <
            calEventFilter.find("input").length
                ? selectAll.prop("checked", false)
                : selectAll.prop("checked", true);
            fetchEvents();
        });
    }

    // Selected Checkboxes
    function selectedFilters() {
        var selected = [];
        $(".calendar-events-filter input:checked").each(function () {
            selected.push($(this).attr("data-value"));
        });
        return selected;
    }

    function fetchEvents(info, successCallback) {
        var filters = selectedFilters();

        $("#js-task-list-table tr[data-id]").each(function (e) {
            var status = $(this)
                .find("td > span[data-status]")
                .attr("data-status");
            if (status == -1) {
                status = 100;
            }

            var date = $(this).find("td > span[data-time]").attr("data-time");
            var today = Math.floor(Date.now() / 1000);
            if (date < today && (status == 1 || status == 0)) {
                status = 1000;
            }

            var status_text = filterStatus[status] ?? "";
            if (!filters.includes(status_text)) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    }
    fetchEvents();

	var sidebar = $(".update-item-sidebar");
	$("#js-task-list-table tbody tr").on("click", function () {
        var el = $(this);

            if (el.find(".kanban-item-avatar").length) {
                el.find(".kanban-item-avatar").on("click", function (e) {
                    e.stopPropagation();
                });
            }

            var elementId = el.attr("data-id");
            var url = "?show=task&task_id=" + elementId;
            var currentUrl = window.location.href.split("?", (window.location.href).length)[0];
            history.replaceState(null, null, window.location.pathname + url);
            currentUrl = window.location.href.substring(currentUrl.toString().length, (window.location.href).toString().length);
            sidebar.modal("show");

            const urlParams = new URLSearchParams(window.location.search);
            const taskId = urlParams.get('task_id');

            var taskRoute = taskRoutes.replace(':taskId', taskId);
            const response = fetch(taskRoute);
            response.then(res => {
                if (res.ok) {
                    return res.text();
                } else {
                    throw new Error('Something went wrong here');
                }
            }).then(html => {
				console.log(targetTaskModal.find('.task-wrapper').html())
                targetTaskModal.find('.task-wrapper').html(html);
            }).catch(error => {
                targetTaskModal.find('.task-wrapper').html(error);
            });

    })
});
