/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 **/

"use-strict";

const modalCalendarTask = $('#modalCalendarTask');

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
	$("#select-all").on("change", function() {
		var is_checked = $(this).attr("checked");
		if (typeof is_checked !== 'undefined' && is_checked !== false) {
			$('.input-filter:checked').each(function() {
				$(this).prop("checked", false);
			});
			$(this).attr("checked", false);
		} else {
			$('.input-filter').each(function() {
				$(this).prop("checked", true);
			});
			$(this).attr("checked", true);
		}
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
        // // We are reading event object from app-calendar-events.js file directly by including that file above app-calendar file.
        // // You should make an API call, look into above commented API call for reference
        // selectedEvents = events.filter(function (event) {
        //     // console.log(event.extendedProps.calendar.toLowerCase());
        //     return calendars.includes(
        //         event.extendedProps.calendar.toLowerCase()
        //     );
        // });
        // // if (selectedEvents.length > 0) {
        // successCallback(selectedEvents);
        // // }
		console.log(filters)
    }
    fetchEvents();
});
