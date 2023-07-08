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
    var addAssignee = $(".add-assignee"),
        addReviewer = $(".add-reviewer"),
        removeAssignee = $(".remove-assignee"),
        removeReviewer = $(".remove-reviewer");

	function assignTask(acc_id) {
		var currentUrl = window.location.href;
		var task_id = currentUrl.split('/').pop();
		var csrfToken = $('input[name="csrf-token"]').val();
		var isRtl = $('html').attr('data-textdirection') === 'rtl';

		console.log(task_id);
		console.log(acc_id);
		$.ajax({
			url: "assign-to",
			method: "POST",
			headers: {
				'X-CSRF-TOKEN': csrfToken  // Include the CSRF token in the headers
			  },
			data: {
				task_id: task_id,
				acc_id: acc_id,
			},
			success: function (response) {
				// Handle success response
				setTimeout(function () {
					toastr["success"](response.message, "Success!", {
						showMethod: "slideDown",
						hideMethod: "slideUp",
						progressBar: true,
						closeButton: true,
						tapToDismiss: false,
						rtl: isRtl,
					});
				}, 2000);
			},
			error: function (response) {
				// Handle error response
				setTimeout(function () {
					toastr["error"](response.message, "Error!", {
						showMethod: "slideDown",
						hideMethod: "slideUp",
						progressBar: true,
						closeButton: true,
						tapToDismiss: false,
						rtl: isRtl,
					});
				}, 2000);
			},
		});
	}

	function removeAss(acc_id) {
		var currentUrl = window.location.href;
		var task_id = currentUrl.split('/').pop();
		var csrfToken = $('input[name="csrf-token"]').val();
		var isRtl = $('html').attr('data-textdirection') === 'rtl';

		// console.log(task_id);
		// console.log(acc_id);
		$.ajax({
			url: "assign-to",
			method: "POST",
			headers: {
				'X-CSRF-TOKEN': csrfToken  // Include the CSRF token in the headers
			  },
			data: {
				task_id: task_id,
				acc_id: acc_id,
			},
			success: function (response) {
				// Handle success response
				setTimeout(function () {
					toastr["success"](response.message, "Success!", {
						showMethod: "slideDown",
						hideMethod: "slideUp",
						progressBar: true,
						closeButton: true,
						tapToDismiss: false,
						rtl: isRtl,
					});
				}, 2000);
			},
			error: function (response) {
				// Handle error response
				setTimeout(function () {
					toastr["error"](response.message, "Error!", {
						showMethod: "slideDown",
						hideMethod: "slideUp",
						progressBar: true,
						closeButton: true,
						tapToDismiss: false,
						rtl: isRtl,
					});
				}, 2000);
			},
		});
	}

	addAssignee.on('click', function () {
		var acc_id = $(this).attr('id').split('_')[0];
		assignTask(acc_id);
	});
});
