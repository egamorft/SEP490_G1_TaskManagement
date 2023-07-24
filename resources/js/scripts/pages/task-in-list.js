/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 **/

"use-strict";
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
        selectAll = $(".select-all"),
        calEventFilter = $(".calendar-events-filter"),
        filterInput = $(".input-filter");

    // --------------------------------------------

    // Selected Checkboxes
    function selectedCalendars() {
        var selected = [];
        $(".calendar-events-filter input:checked").each(function () {
            selected.push($(this).attr("data-value"));
        });
        console.log(selected);
        return selected;
    }

    function fetchEvents(info, successCallback) {
        var calendars = selectedCalendars();
        // We are reading event object from app-calendar-events.js file directly by including that file above app-calendar file.
        // You should make an API call, look into above commented API call for reference
        selectedEvents = events.filter(function (event) {
            // console.log(event.extendedProps.calendar.toLowerCase());
            return calendars.includes(
                event.extendedProps.calendar.toLowerCase()
            );
        });
        // if (selectedEvents.length > 0) {
        successCallback(selectedEvents);
        // }
    }

    // Event click function
    function eventClick(info) {
        const task_id = info.event.id;
        var url = "?show=task&task_id=" + task_id;
        var currentUrl = window.location.href.split("?", (window.location.href).length)[0];
        history.replaceState(null, null, window.location.pathname + url);
        currentUrl = window.location.href.substring(currentUrl.toString().length, (window.location.href).toString().length);
        modalCalendarTask.modal("show");

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
            modalCalendarTask.find('.task-wrapper').html(html);
        }).catch(error => {
            modalCalendarTask.find('.task-wrapper').html(error);
        });
    }

    eventClick();
    fetchEvents();
    $("#addTaskFormCalendar").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr("action");
        var method = form.attr("method");
        var _token = $('meta[name="csrf-token"]').attr("content");
        var description = taskDesc.querySelector(".ql-editor").innerHTML;
        var data = form.serializeArray();
        data.push({ name: "_token", value: _token });
        data.push({ name: "description", value: description });
        $.ajax({
            url: url,
            method: method,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $("#spinnerBtnProjectModalCalendar").show();
                $("#submitBtnProjectModalCalendar").hide();
            },
            success: function (response) {
                // handle success
                if (response.success) {
                    location.reload();
                }
            },
            error: function (response) {
                setTimeout(function () {
                    $("#spinnerBtnProjectModalCalendar").hide();
                    $("#submitBtnProjectModalCalendar").show();
                    if (response.status == 422) {
                        var errors = response.responseJSON.errors;
                        for (var key in errors) {
                            $("#" + key).addClass(" is-invalid");
                            $("#error-" + key).show();
                            $("#error-" + key).text(errors[key][0]);
                        }
                    }
                }, 500);
            },
        });
    });
});
