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

    var searchFilter = $("#todo-search"),
        listItemFilter = $(".list-group-filters"),
        noResults = $(".no-results");

    $(document).ready(function () {
        var queryParams = new URLSearchParams(window.location.search);
		var role = queryParams.get("role");
		var q = queryParams.get("q");

		listItemFilter.find("a").removeClass('active');
		if (!role) {
			role = 'viewer';
		}
		listItemFilter.find("#"+role+"_role").addClass('active');

		if (q) {
			searchFilter.val(q);
		}

    });

    // Filter
    function filter() {
        var role = listItemFilter.find("a.active").attr('id').split('_')[0],
            q = searchFilter.val();
        var queryParams = new URLSearchParams(window.location.search);

        // Set new or modify existing parameter value.
        if (role && role != "viewer") {
            queryParams.set("role", role);
        } else {
            queryParams.delete("role");
        }

        if (q) {
            queryParams.set("q", q);
        } else {
            queryParams.delete("q");
        }

        // Replace current querystring with the new one.
        window.location.href = window.location.origin + window.location.pathname + "?" + queryParams.toString();
        // window.history.replaceState(null, null, "?&" + queryParams.toString());
    }

    // Filter task
    if (searchFilter.length) {
        searchFilter.on("keyup", function (event) {
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

			if (event.which === 13) {
				filter();
				console.log('Enter key pressed!');
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

});
