/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 **/

"use-strict";

// RTL Support
var direction = "ltr",
    assetPath = "../../../app-assets/",
    csrfToken = $('input[name="csrf-token"]').val(),
    section = $('#section-block'),
    isRtl = $('html').attr('data-textdirection') === 'rtl';
if ($("html").data("textdirection") == "rtl") {
    direction = "rtl";
}

if ($("body").attr("data-framework") === "laravel") {
    assetPath = $("body").attr("data-asset-path");
}

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

    // --------------------------------------------------------------------------------------------------
    // AXIOS: fetchEvents
    // * This will be called by fullCalendar to fetch events. Also this can be used to refetch events.
    // --------------------------------------------------------------------------------------------------
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
        console.log(info);
        alert("Show card detail");
    }

    // Calendar plugins
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        validRange: {
            start: projectStartDate,
            end: projectEndDate
        },
        events: fetchEvents,
        editable: true,
        weekends: true,
        dragScroll: true,
        dayMaxEvents: 2,
        eventResizableFromStart: true,
        customButtons: {
            sidebarToggle: {
                text: "Sidebar",
            },
        },
        headerToolbar: {
            start: "sidebarToggle, prev,next, title",
            end: "",
        },
        direction: direction,
        initialDate: new Date(),
        navLinks: true, // can click day/week names to navigate views
        eventClassNames: function ({ event: calendarEvent }) {
            const colorName =
                calendarsColor[calendarEvent._def.extendedProps.calendar];

            return [
                // Background Color
                "bg-light-" + colorName,
            ];
        },
        dateClick: function (info) {
            var date = moment(info.date).format("YYYY-MM-DD");
            console.log(date);
        },
        eventClick: function (info) {
            eventClick(info);
        },
        eventDrop: function (e) {
            var id = e.event.id;
            const days_diff = e.delta.days;
            $.ajax({
                url: '/move-task-calendar',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken  // Include the CSRF token in the headers
                },
                data: {
                    task_id: id,
                    days_diff: days_diff
                },
                beforeSend: function () {
                    section.block({
                        message:
                            '<div class="d-flex justify-content-center align-items-center"><p class="me-50 mb-0">Please wait...</p><div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
                        timeout: 2000,
                        css: {
                            backgroundColor: 'transparent',
                            color: '#fff',
                            border: '0'
                        },
                        overlayCSS: {
                            opacity: 0.5
                        }
                    });
                },
                success: function (response) {
                    // Handle success response
                    if (response.success) {
                        setTimeout(function () {
                            toastr['success'](response.message, 'Error!', {
                                showMethod: 'slideDown',
                                hideMethod: 'slideUp',
                                progressBar: true,
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl
                            });
                        }, 2000);
                    }
                },
                error: function (response) {
                    var errMsg = "Sorry, something went wrong here. Load the page and try again!!";
                    if (response.message) {
                        errMsg = response.message;
                    }
                    // Handle error response
                    setTimeout(function () {
                        toastr['error'](errMsg, 'Error!', {
                            showMethod: 'slideDown',
                            hideMethod: 'slideUp',
                            progressBar: true,
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                    }, 2000);
                }
            });
        },
    });

    // Render calendar
    calendar.render();

    // Select all & filter functionality
    if (selectAll.length) {
        selectAll.on("change", function () {
            var $this = $(this);

            if ($this.prop("checked")) {
                calEventFilter.find("input").prop("checked", true);
            } else {
                calEventFilter.find("input").prop("checked", false);
            }
            calendar.refetchEvents();
        });
    }

    if (filterInput.length) {
        filterInput.on("change", function () {
            $(".input-filter:checked").length <
                calEventFilter.find("input").length
                ? selectAll.prop("checked", false)
                : selectAll.prop("checked", true);
            calendar.refetchEvents();
        });
    }

    const taskDesc = document.getElementById('task-desc');
    //Add task form calendar
    $('#addTaskFormCalendar').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var _token = $('meta[name="csrf-token"]').attr('content');
        var description = taskDesc.querySelector('.ql-editor').innerHTML;
        var data = form.serializeArray();
        data.push({name: '_token', value: _token});
        data.push({name: 'description', value: description});
        $.ajax({
            url: url,
            method: method,
            data: data,
            dataType: 'json',
            beforeSend: function () {
                $('#spinnerBtnProjectModalCalendar').show();
                $('#submitBtnProjectModalCalendar').hide();
            },
            success: function (response) {
                // handle success
                if (response.success) {
                    location.reload();
                }
            },
            error: function (response) {
                setTimeout(function () {
                    $('#spinnerBtnProjectModalCalendar').hide();
                    $('#submitBtnProjectModalCalendar').show();
                    if (response.status == 422) {
                        var errors = response.responseJSON.errors;
                        for (var key in errors) {
                            $('#' + key).addClass(' is-invalid');
                            $('#error-' + key).show();
                            $('#error-' + key).text(errors[key][0])
                        }
                    }
                }, 500);
            }
        });
    });
});
