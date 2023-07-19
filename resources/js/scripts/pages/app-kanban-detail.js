/*=========================================================================================
	File Name: dashboard-ecommerce.js
	Description: dashboard ecommerce page content with Apexchart Examples
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: PIXINVENT
	Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function () {
	// Action sau khi click button edit trong description
	$(".description-button-edit").on("click", function () {
		$(".description-button-edit").hide();

		var toolbarOptions = [
			["bold", "italic", "underline", "strike"], // toggled buttons
			["blockquote", "code-block"],

			[{ header: 1 }, { header: 2 }], // custom button values
			[{ list: "ordered" }, { list: "bullet" }],
			[{ script: "sub" }, { script: "super" }], // superscript/subscript
			[{ indent: "-1" }, { indent: "+1" }], // outdent/indent
			[{ direction: "rtl" }], // text direction

			[{ size: ["small", false, "large", "huge"] }], // custom dropdown
			[{ header: [1, 2, 3, 4, 5, 6, false] }],

			[{ color: [] }, { background: [] }], // dropdown with defaults from theme
			[{ font: [] }],
			[{ align: [] }],

			["clean"], // remove formatting button
		];

		var quill = new Quill(".description-content-editor", {
			modules: {
				toolbar: toolbarOptions,
			},
			theme: "snow",
		});

		var htmlButton = `
            <div class="description-button">
                <button type="submit" class="btn btn-primary save-description">Save</button>
                <button type="button" class="btn btn-secondary cancel-description">Cancel</button>
            </div>
        `;

		$(".kanban-detail-description > div").append(htmlButton);

		// Action để return dữ liệu ban đầu khi click button cancel
		$(".cancel-description").on("click", function () {
			$(".kanban-detail-description .ql-toolbar").remove();
			$(".description-content-editor")
				.removeClass("ql-container")
				.removeClass("ql-snow")
				.html(
					`Đường dẫn : Login → Dashboard → Chọn Project trong side bar mục ‘My Projects’ → Chọn mục
                Calendar → Hiển thị màn chức năng Calendar View để xem danh sách các task trong project
                (ảnh mô tả ‘Calendar View.png’)
                <br>Khi di chuyển Task sang 1 ngày khác trong Calendar thì tiến độ của dự án cũng phải
                cập nhật theo ngày đó`
				);
			$(".description-button-edit").show();
			$(".description-button").remove();
		});
	});

	// Action submit form sau khi upload files
	$("#formFileMultiple").on("change", function (e) {
		e.preventDefault();
		var input = this;
		var canvas = "#formImageUpload";
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$(canvas).submit();
			};
			// reader.readAsDataURL(input.files[0]);

			var files = input.files
			var html = ``;
			
			for (let i = 0; i < files.length; i++) {
				var file = files[i];
				var fileName = file.name;
				html += `
                <div class='file-name'>
                    <i data-feather="file" class='custom-mini-icon'></i>
                    <span class='file-item -txt'>${fileName}</span>
                </div>
              	`;
			}
			$(".custom-file-content").append(html);

			feather.replace()
		}
	});

	//Xử lý comment input khi enter
	$("#comment-input").keypress(function (e) {
		var canvas = "#formUploadComment";
		if (e.which == 13) {
			$(canvas).submit();
			return false;
		}

		submit_form(canvas, function () {
			alert("Comment thành công");
		});
	});

	function submit_form(canvas, fn = false) {
		$("#formImageUpload").on(
			"submit",
			fn ||
			function (e) {
				alert("Submit form thành công");
			}
		);
	}

	$(".button-filter-header").on("click", function () {
		if ($(".filter-list").hasClass("hidden")) {
			$(".filter-list").removeClass("hidden");
		} else {
			$(".filter-list").addClass("hidden");
		}
	});

	$(".user-add-assignee").on("click", function () {
		var dropdown = $(".dropdown-menu-assignee");
		if (dropdown.hasClass("hidden")) {
			dropdown.removeClass("hidden");
		} else {
			dropdown.addClass("hidden");
		}
	});

	$(".user-add-reviewer").on("click", function () {
		var dropdown = $(".dropdown-menu-reviewer");
		if (dropdown.hasClass("hidden")) {
			dropdown.removeClass("hidden");
		} else {
			dropdown.addClass("hidden");
		}
	});

	function onClickAddEvent() {
		$(".user-add-assignee").on("click", function () {
			var dropdown = $(".dropdown-menu-assignee");
			if (dropdown.hasClass("hidden")) {
				dropdown.removeClass("hidden");
			} else {
				dropdown.addClass("hidden");
			}
		});
	
		$(".user-add-reviewer").on("click", function () {
			var dropdown = $(".dropdown-menu-reviewer");
			if (dropdown.hasClass("hidden")) {
				dropdown.removeClass("hidden");
			} else {
				dropdown.addClass("hidden");
			}
		});
	}

	$(".edit-prevtask-wrapper").on("click", function () {
		var prevTask = $("#addPrevTask");
		if (prevTask.hasClass("hidden")) {
			prevTask.removeClass("hidden");
		} else {
			prevTask.addClass("hidden");
		}
	});
	
	$(".add-assignee").on("click", function() {
		var input = this;
		var dataImage = $(input).find("img");
		var imageSrc = dataImage.attr("src");

		$(this).closest(".kanban-detail-user").find(".user-add-assignee").remove();
		$(this).closest(".kanban-detail-user").append(`
			<img class="user-add-assignee" src="${imageSrc}" alt="IMG" />
		`);
		$(this).closest(".dropdown-menu-assignee").hide();
		// onClickAddEvent();
	});

	$(".add-reviewer").on("click", function() {
		var input = this;
		var dataImage = $(input).find("img");
		var imageSrc = dataImage.attr("src");

		$(this).closest(".kanban-detail-user").find(".user-add-reviewer").remove();
		$(this).closest(".kanban-detail-user").append(`
			<img class="user-add-reviewer" src="${imageSrc}" alt="IMG" />
		`);
		$(this).closest(".dropdown-menu-reviewer").hide();
		// onClickAddEvent();
	});
});

(function (window, document, $) {
	"use strict";

	/*******  Flatpickr  *****/
	var basicPickr = $(".flatpickr-basic"),
		timePickr = $(".flatpickr-time"),
		dateTimePickr = $(".flatpickr-date-time"),
		multiPickr = $(".flatpickr-multiple"),
		rangePickr = $(".flatpickr-range"),
		rangePickrTask = $(".flatpickr-range-task"),
		humanFriendlyPickr = $(".flatpickr-human-friendly"),
		disabledRangePickr = $(".flatpickr-disabled-range"),
		inlineRangePickr = $(".flatpickr-inline");

	// Default
	if (basicPickr.length) {
		basicPickr.flatpickr();
	}

	// Time
	if (timePickr.length) {
		timePickr.flatpickr({
			enableTime: true,
			noCalendar: true,
		});
	}

	// Date & TIme
	if (dateTimePickr.length) {
		dateTimePickr.flatpickr({
			enableTime: true,
		});
	}

	// Multiple Dates
	if (multiPickr.length) {
		multiPickr.flatpickr({
			weekNumbers: true,
			mode: "multiple",
			minDate: "today",
		});
	}

	// Range
	if (rangePickr.length) {
		rangePickr.flatpickr({
			mode: "range",
		});
	}

	// Range task
	if (rangePickrTask.length) {
		rangePickrTask.flatpickr({
			mode: "range",
			enable: [
				{
					from: projectStartDate,
					to: projectEndDate,
				},
			],
		});
	}

	// Human Friendly
	if (humanFriendlyPickr.length) {
		humanFriendlyPickr.flatpickr({
			altInput: true,
			altFormat: "F j, Y",
			dateFormat: "Y-m-d",
		});
	}

	// Disabled Range
	if (disabledRangePickr.length) {
		disabledRangePickr.flatpickr({
			dateFormat: "Y-m-d",
			disable: [
				{
					from: new Date().fp_incr(2),
					to: new Date().fp_incr(7),
				},
			],
		});
	}

	// Inline
	if (inlineRangePickr.length) {
		inlineRangePickr.flatpickr({
			inline: true,
		});
	}
	/*******  Pick-a-date Picker  *****/
	// Basic date
	$(".pickadate").pickadate();

	// Format Date Picker
	$(".format-picker").pickadate({
		format: "mmmm, d, yyyy",
	});

	// Date limits
	$(".pickadate-limits").pickadate({
		min: [2019, 3, 20],
		max: [2019, 5, 28],
	});

	// Disabled Dates & Weeks

	$(".pickadate-disable").pickadate({
		disable: [1, [2019, 3, 6], [2019, 3, 20]],
	});

	// Picker Translations
	$(".pickadate-translations").pickadate({
		formatSubmit: "dd/mm/yyyy",
		monthsFull: [
			"Janvier",
			"Février",
			"Mars",
			"Avril",
			"Mai",
			"Juin",
			"Juillet",
			"Août",
			"Septembre",
			"Octobre",
			"Novembre",
			"Décembre",
		],
		monthsShort: [
			"Jan",
			"Fev",
			"Mar",
			"Avr",
			"Mai",
			"Juin",
			"Juil",
			"Aou",
			"Sep",
			"Oct",
			"Nov",
			"Dec",
		],
		weekdaysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
		today: "aujourd'hui",
		clear: "clair",
		close: "Fermer",
	});

	// Month Select Picker
	$(".pickadate-months").pickadate({
		selectYears: false,
		selectMonths: true,
	});

	// Month and Year Select Picker
	$(".pickadate-months-year").pickadate({
		selectYears: true,
		selectMonths: true,
	});

	// Short String Date Picker
	$(".pickadate-short-string").pickadate({
		weekdaysShort: ["S", "M", "Tu", "W", "Th", "F", "S"],
		showMonthsShort: true,
	});

	// Change first weekday
	$(".pickadate-firstday").pickadate({
		firstDay: 1,
	});

	/*******    Pick-a-time Picker  *****/
	// Basic time
	$(".pickatime").pickatime();

	// Format options
	$(".pickatime-format").pickatime({
		// Escape any “rule” characters with an exclamation mark (!).
		format: "T!ime selected: h:i a",
		formatLabel: "HH:i a",
		formatSubmit: "HH:i",
		hiddenPrefix: "prefix__",
		hiddenSuffix: "__suffix",
	});

	// Format options
	$(".pickatime-formatlabel").pickatime({
		formatLabel: function (time) {
			var hours = (time.pick - this.get("now").pick) / 60,
				label =
					hours < 0
						? " !hours to now"
						: hours > 0
							? " !hours from now"
							: "now";
			return (
				"h:i a <sm!all>" +
				(hours ? Math.abs(hours) : "") +
				label +
				"</sm!all>"
			);
		},
	});

	// Min - Max Time to select
	$(".pickatime-min-max").pickatime({
		// Using Javascript
		min: new Date(2015, 3, 20, 7),
		max: new Date(2015, 7, 14, 18, 30),

		// Using Array
		// min: [7,30],
		// max: [14,0]
	});

	// Intervals
	$(".pickatime-intervals").pickatime({
		interval: 150,
	});

	// Disable Time
	$(".pickatime-disable").pickatime({
		disable: [
			// Disable Using Integers
			3, 5, 7, 13, 17, 21,

			/* Using Array */
			// [0,30],
			// [2,0],
			// [8,30],
			// [9,0]
		],
	});

	// Close on a user action
	$(".pickatime-close-action").pickatime({
		closeOnSelect: false,
		closeOnClear: false,
	});
})(window, document, jQuery);
