/*=========================================================================================
    File Name: dashboard-ecommerce.js
    Description: dashboard ecommerce page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function () {
    "use strict";

    var todoFilter = $("#todo-search"),
        listItemFilter = $(".list-group-filters"),
        noResults = $(".no-results"),
        checkbox = $(".calendar-events-filter");

    $(document).ready(function () {
        var queryParams = new URLSearchParams(window.location.search);
		var role = queryParams.get("role");
		var todo = queryParams.get("todo");
		var overdue = queryParams.get("overdue");
		var late = queryParams.get("late");
		var ontime = queryParams.get("ontime");
		var reviewing = queryParams.get("reviewing");
		var doing = queryParams.get("doing");
		var is_check_all = false;

		if (!todo && !doing && !reviewing && !ontime && !late && !overdue) {
			is_check_all = true;
		}

		// $("#doing-task").prop("checked", true);
		// $("#late-task").prop("checked", true);
		// $("#overdue-task").prop("checked", true);
		// $("#ontime-task").prop("checked", true);
		// $("#reviewing-task").prop("checked", true);
		// $("#todo-task").prop("checked", true);

		if (!todo && !is_check_all) {
			$("#todo-task").prop("checked", false);
		}
		if (!doing && !is_check_all) {
			$("#doing-task").prop("checked", false);
		}
		if (!reviewing && !is_check_all) {
			$("#reviewing-task").prop("checked", false);
		}
		if (!ontime && !is_check_all) {
			$("#ontime-task").prop("checked", false);
		}
		if (!late && !is_check_all) {
			$("#late-task").prop("checked", false);
		}
		if (!overdue && !is_check_all) {
			$("#overdue-task").prop("checked", false);
		}

		listItemFilter.find("a").removeClass('active');
		if (!role) {
			role = 'viewer';
		}
		listItemFilter.find("#"+role+"_role").addClass('active');

    });

    // Filter
    function filter() {
        var role = listItemFilter.find("a.active").attr('id').split('_')[0],
            todo = $("#todo-task").is(":checked"),
            doing = $("#doing-task").is(":checked"),
            reviewing = $("#reviewing-task").is(":checked"),
            ontime = $("#ontime-task").is(":checked"),
            late = $("#late-task").is(":checked"),
            overdue = $("#overdue-task").is(":checked");
        var queryParams = new URLSearchParams(window.location.search);

        // Set new or modify existing parameter value.
        if (role && role != "viewer") {
            queryParams.set("role", role);
        } else {
            queryParams.delete("role");
        }

        if (todo) {
            queryParams.set("todo", todo);
        } else {
            queryParams.delete("todo");
        }

        if (doing) {
            queryParams.set("doing", doing);
        } else {
            queryParams.delete("doing");
        }

        if (reviewing) {
            queryParams.set("reviewing", reviewing);
        } else {
            queryParams.delete("reviewing");
        }

        if (ontime) {
            queryParams.set("ontime", ontime);
        } else {
            queryParams.delete("ontime");
        }

        if (late) {
            queryParams.set("late", late);
        } else {
            queryParams.delete("late");
        }

        if (overdue) {
            queryParams.set("overdue", overdue);
        } else {
            queryParams.delete("overdue");
        }

		if (todo && doing && reviewing && ontime && late && overdue) {
			queryParams.delete("overdue");
            queryParams.delete("late");
            queryParams.delete("ontime");
            queryParams.delete("reviewing");
            queryParams.delete("doing");
            queryParams.delete("todo");
		}

		if ((!todo || !doing || !reviewing || !ontime || !late || !overdue) && role == "viewer" ) {
			queryParams.set("role", role);
		}

        // Replace current querystring with the new one.
        window.location.href = window.location.origin + window.location.pathname + "?&" + queryParams.toString();
        // window.history.replaceState(null, null, "?&" + queryParams.toString());
    }

    // Filter task
    if (todoFilter.length) {
        todoFilter.on("keyup", function () {
            var value = $(this).val().toLowerCase();
            if (value !== "") {
                $(".todo-item").filter(function () {
                    $(this).toggle(
                        $(this).text().toLowerCase().indexOf(value) > -1
                    );
                });
                var tbl_row = $(".todo-item:visible").length; //here tbl_test is table name

                //Check if table has row or not
                if (tbl_row == 0) {
                    if (!$(noResults).hasClass("show")) {
                        $(noResults).addClass("show");
                    }
                } else {
                    $(noResults).removeClass("show");
                }
            } else {
                // If filter box is empty
                $(".todo-item").show();
                if ($(noResults).hasClass("show")) {
                    $(noResults).removeClass("show");
                }
            }
        });
    }

    // Add class active on click of sidebar filters list
    if (listItemFilter.length) {
        listItemFilter.find("a").on("click", function () {
            if (listItemFilter.find("a").hasClass("active")) {
                listItemFilter.find("a").removeClass("active");
            }
            $(this).addClass("active");
            filter();
        });
    }

    checkbox.find("input").on("change", function () {
        filter();
    });
});
