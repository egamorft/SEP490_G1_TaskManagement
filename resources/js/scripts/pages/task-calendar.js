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
    assetPath = "../../../app-assets/";
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
});
