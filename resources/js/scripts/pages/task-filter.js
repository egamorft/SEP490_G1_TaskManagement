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

    // Filter
    function filter() {
        var role = listItemFilter.find("a.active span").html(),
            todo = $("#todo-task").is(":checked"),
            doing = $("#doing-task").is(":checked"),
            reviewing = $("#reviewing-task").is(":checked"),
            ontime = $("#ontime-task").is(":checked"),
            late = $("#late-task").is(":checked"),
            overdue = $("#overdue-task").is(":checked");
        var queryParams = new URLSearchParams(window.location.search);

        // Set new or modify existing parameter value.
		if (role) {
			queryParams.set("role",role);
		} else {
			queryParams.delete("role");
		}

		if (todo) {
			queryParams.set("todo",todo);
		} else {
			queryParams.delete("todo");
		}

		if (doing) {
			queryParams.set("doing",doing);
		} else {
			queryParams.delete("doing");
		}

		if (reviewing) {
			queryParams.set("reviewing",reviewing);
		} else {
			queryParams.delete("reviewing");
		}

		if (ontime) {
			queryParams.set("ontime",ontime);
		} else {
			queryParams.delete("ontime");
		}

		if (late) {
			queryParams.set("late",late);
		} else {
			queryParams.delete("late");
		}

		if (overdue) {
			queryParams.set("overdue",overdue);
		} else {
			queryParams.delete("overdue");
		}

        // Replace current querystring with the new one.
        history.replaceState(null, null, "?&" + queryParams.toString());

        // $.ajax({
        // 	url:"task-list/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
        // 	method:"GET", // phương thức gửi dữ liệu.
        // 	data:{
        // 		q: todoFilter.val().toLowerCase(),
        // 		role: listItemFilter.find("a.active span").html(),
        // 		todo: $('#todo-task').is(":checked"),
        // 		doing: $('#doing-task').is(":checked"),
        // 		reviewing: $('#reviewing-task').is(":checked"),
        // 		ontime: $('#ontime-task').is(":checked"),
        // 		late: $('#late-task').is(":checked"),
        // 		overdue: $('#overdue-task').is(":checked"),

        // 	},
        // 	success:function(data){ //dữ liệu nhận về
        // 		console.log("done");
        // 		console.log(data);
        //    }
        //  });
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
