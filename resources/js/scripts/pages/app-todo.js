/*=========================================================================================
    File Name: app-todo.js
    Description: app-todo
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

"use strict";

$(function () {
    var taskTitle,
        flatPickr = $(".task-due-date"),
        newTaskModal = $(".sidebar-todo-modal"),
        newTaskForm = $("#form-modal-task"),
        newListForm = $("#form-modal-task-list"),
        favoriteStar = $(".todo-item-favorite"),
        modalTitle = $(".modal-title"),
        addBtn = $(".add-todo-item"),
        addTaskBtn = $(".add-task button"),
        updateTodoItem = $(".update-todo-item"),
        updateBtns = $(".update-btn"),
        taskDesc = $("#task-desc"),
        taskAssignSelect = $("#task-assigned"),
        taskReviewSelect = $("#task-reviewer"),
        taskTag = $("#task-tag"),
        overlay = $(".body-content-overlay"),
        menuToggle = $(".menu-toggle"),
        sidebarToggle = $(".sidebar-toggle"),
        sidebarLeft = $(".sidebar-left"),
        sidebarMenuList = $(".sidebar-menu-list"),
        todoFilter = $("#todo-search"),
        sortAsc = $(".sort-asc"),
        sortDesc = $(".sort-desc"),
        todoTaskList = $("#new-task-modal"),
        todoTaskListWrapper = $(".todo-task-list-wrapper"),
        listItemFilter = $(".list-group-filters"),
        noResults = $(".no-results"),
        checkboxId = 100,
        isRtl = $("html").attr("data-textdirection") === "rtl",
        editBtn = $("#edit-task-btn"),
        removeBtn = $("#remove-task-btn"),
        addTaskListBtn = $("#new-task-list-modal");

    var assetPath = "../../../app-assets/";
    if ($("body").attr("data-framework") === "laravel") {
        assetPath = $("body").attr("data-asset-path");
    }

    // if it is not touch device
    if (!$.app.menu.is_touch_device()) {
        if (sidebarMenuList.length > 0) {
            var sidebarListScrollbar = new PerfectScrollbar(
                sidebarMenuList[0],
                {
                    theme: "dark",
                }
            );
        }
        if (todoTaskListWrapper.length > 0) {
            var taskListScrollbar = new PerfectScrollbar(
                todoTaskListWrapper[0],
                {
                    theme: "dark",
                }
            );
        }
    }
    // if it is a touch device
    else {
        sidebarMenuList.css("overflow", "scroll");
        todoTaskListWrapper.css("overflow", "scroll");
    }

    // Add class active on click of sidebar filters list
    if (listItemFilter.length) {
        listItemFilter.find("a").on("click", function () {
            if (listItemFilter.find("a").hasClass("active")) {
                listItemFilter.find("a").removeClass("active");
            }
            $(this).addClass("active");
        });
    }

    // Main menu toggle should hide app menu
    if (menuToggle.length) {
        menuToggle.on("click", function (e) {
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
        });
    }

    // Todo sidebar toggle
    if (sidebarToggle.length) {
        sidebarToggle.on("click", function (e) {
            e.stopPropagation();
            sidebarLeft.toggleClass("show");
            overlay.addClass("show");
        });
    }

    // On Overlay Click
    if (overlay.length) {
        overlay.on("click", function (e) {
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
            $(newTaskModal).modal("hide");
        });
    }

    // Assign task
    function assignTask(option) {
        if (!option.id) {
            return option.text;
        }
        var $person =
            '<div class="d-flex align-items-center">' +
            '<img class="d-block rounded-circle me-50" src="' +
            $(option.element).data("img") +
            '" height="26" width="26" alt="' +
            option.text +
            '">' +
            '<p class="mb-0">' +
            option.text +
            "</p></div>";

        return $person;
    }

    // Task Assign Select2
    if (taskAssignSelect.length) {
        taskAssignSelect.wrap('<div class="position-relative"></div>');
        taskAssignSelect.select2({
            placeholder: "No Reviewer",
            dropdownParent: taskAssignSelect.parent(),
            templateResult: assignTask,
            templateSelection: assignTask,
            escapeMarkup: function (es) {
                return es;
            },
        });
    }

    // Task Assign Select2
    if (taskReviewSelect.length) {
        taskReviewSelect.wrap('<div class="position-relative"></div>');
        taskReviewSelect.select2({
            placeholder: "Unassigned",
            dropdownParent: taskReviewSelect.parent(),
            templateResult: assignTask,
            templateSelection: assignTask,
            escapeMarkup: function (es) {
                return es;
            },
        });
    }

    // Task Tags
    if (taskTag.length) {
        taskTag.wrap('<div class="position-relative"></div>');
        taskTag.select2({
            placeholder: "Select tag",
        });
    }

    // Favorite star click
    if (favoriteStar.length) {
        $(favoriteStar).on("click", function () {
            $(this).toggleClass("text-warning");
        });
    }

    // Flat Picker
    if (flatPickr.length) {
        flatPickr.flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: "today",
            onReady: function (selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr("step", null);
                }
            },
        });
    }

    // Todo Description Editor
    if (taskDesc.length) {
        var todoDescEditor = new Quill("#task-desc", {
            bounds: "#task-desc",
            modules: {
                formula: true,
                syntax: true,
                toolbar: ".desc-toolbar",
            },
            placeholder: "Write Your Description",
            theme: "snow",
        });
    }

    // On add new item button click, clear sidebar-right field fields
    if (addTaskBtn.length) {
        addTaskBtn.on("click", function (e) {
            addBtn.removeClass("d-none");
            updateBtns.addClass("d-none");
            modalTitle.text("Add Task");
            // newTaskModal.modal('show');
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
            newTaskModal.find(".new-todo-item-title").val("");
            var quill_editor = taskDesc.find(".ql-editor");
            quill_editor[0].innerHTML = "";
        });
    }

    // On edit item button click, clear sidebar-right field fields
    if (editBtn.length) {
        editBtn.on("click", function (e) {
            addBtn.removeClass("d-none");
            updateBtns.addClass("d-none");
            modalTitle.text("Add Task");
            newTaskModal.modal("show");
            sidebarLeft.removeClass("show");
            overlay.removeClass("show");
            newTaskModal.find(".new-todo-item-title").val("");
            var quill_editor = taskDesc.find(".ql-editor");
            quill_editor[0].innerHTML = "";
        });
    }

    // To add new task form
    if (newTaskForm.length) {
        newTaskForm.validate({
            ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
            rules: {
                todoTitleAdd: {
                    required: true,
                },
                "task-assigned": {
                    required: true,
                },
                "task-reviewer": {
                    required: true,
                },
                "task-due-date": {
                    required: true,
                },
            },
        });

        // newTaskForm.on("submit", function (e) {
        //     e.preventDefault();
        //     var isValid = newTaskForm.valid();
        //     if (isValid) {
        //         checkboxId++;
        //         var assignedTo = $("#task-assigned").val(),
        //             todoBadge = "",
        //             membersImg = {
        //                 "Phill Buffer":
        //                     assetPath + "images/portrait/small/avatar-s-3.jpg",
        //                 "Chandler Bing":
        //                     assetPath + "images/portrait/small/avatar-s-1.jpg",
        //                 "Ross Geller":
        //                     assetPath + "images/portrait/small/avatar-s-4.jpg",
        //                 "Monica Geller":
        //                     assetPath + "images/portrait/small/avatar-s-6.jpg",
        //                 "Joey Tribbiani":
        //                     assetPath + "images/portrait/small/avatar-s-2.jpg",
        //                 "Rachel Green":
        //                     assetPath + "images/portrait/small/avatar-s-11.jpg",
        //             };

        //         var todoTitle = $(
        //             ".sidebar-todo-modal .new-todo-item-title"
        //         ).val();
        //         var date = $(".sidebar-todo-modal .task-due-date").val(),
        //             selectedDate = new Date(date),
        //             month = new Intl.DateTimeFormat("en", {
        //                 month: "short",
        //             }).format(selectedDate),
        //             day = new Intl.DateTimeFormat("en", {
        //                 day: "2-digit",
        //             }).format(selectedDate),
        //             todoDate = month + " " + day;

        //         // Badge calculation loop
        //         var selected = $(".task-tag").val();
        //         var badgeColor = {
        //             Team: "primary",
        //             Low: "success",
        //             Medium: "warning",
        //             High: "danger",
        //             Update: "info",
        //         };
        //         $.each(selected, function (index, value) {
        //             todoBadge +=
        //                 '<span class="badge rounded-pill badge-light-' +
        //                 badgeColor[value] +
        //                 ' me-50">' +
        //                 value +
        //                 "</span>";
        //         });
        //         // HTML Output
        //         if (todoTitle != "") {
        //             $(todoTaskList).prepend(
        //                 '<li class="todo-item">' +
        //                     '<div class="todo-title-wrapper">' +
        //                     '<div class="todo-title-area">' +
        //                     feather.icons["more-vertical"].toSvg({
        //                         class: "drag-icon",
        //                     }) +
        //                     '<div class="title-wrapper">' +
        //                     '<div class="form-check">' +
        //                     '<input type="checkbox" class="form-check-input" id="customCheck' +
        //                     checkboxId +
        //                     '" />' +
        //                     '<label class="form-check-label" for="customCheck' +
        //                     checkboxId +
        //                     '"></label>' +
        //                     "</div>" +
        //                     '<span class="todo-title">' +
        //                     todoTitle +
        //                     "</span>" +
        //                     "</div>" +
        //                     "</div>" +
        //                     '<div class="todo-item-action">' +
        //                     '<span class="badge-wrapper me-1">' +
        //                     todoBadge +
        //                     "</span>" +
        //                     '<small class="text-nowrap text-muted me-1">' +
        //                     todoDate +
        //                     "</small>" +
        //                     '<div class="avatar">' +
        //                     '<img src="' +
        //                     membersImg[assignedTo] +
        //                     '" alt="' +
        //                     assignedTo +
        //                     '" height="28" width="28">' +
        //                     "</div>" +
        //                     "</div>" +
        //                     "</div>" +
        //                     "</li>"
        //             );
        //         }
        //         toastr["success"]("Data Saved", "💾 Task Action!", {
        //             closeButton: true,
        //             tapToDismiss: false,
        //             rtl: isRtl,
        //         });
        //         $(newTaskModal).modal("hide");
        //         overlay.removeClass("show");
        //     }
        // });
    }

    // To add new task list form
    if (newListForm.length) {
        newListForm.validate({
            ignore: ".ql-container *", // ? ignoring quill editor icon click, that was creating console error
            rules: {
                listTitleAdd: {
                    required: true,
                },
            },
        });
    }

    // Task checkbox change
    todoTaskListWrapper.on("change", ".form-check", function (event) {
        var $this = $(this).find("input");
        if ($this.prop("checked")) {
            $this.closest(".todo-item").addClass("completed");
            toastr["success"]("Task Completed", "Congratulations!! 🎉", {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl,
            });
        } else {
            $this.closest(".todo-item").removeClass("completed");
        }
    });
    todoTaskListWrapper.on("click", ".form-check", function (event) {
        event.stopPropagation();
    });

    // Updating Data Values to Fields
    if (updateTodoItem.length) {
        updateTodoItem.on("click", function (e) {
            var isValid = newTaskForm.valid();
            e.preventDefault();
            if (isValid) {
                var $edit_title = newTaskForm
                    .find(".new-todo-item-title")
                    .val();
                $(taskTitle).text($edit_title);

                // toastr["success"]("Data Saved", "💾 Task Action!", {
                //     closeButton: true,
                //     tapToDismiss: false,
                //     rtl: isRtl,
                // });
                $(newTaskModal).modal("hide");
            }
        });
    }

    // Sort Ascending
    if (sortAsc.length) {
        sortAsc.on("click", function () {
            todoTaskListWrapper
                .find("li")
                .sort(function (a, b) {
                    return $(b).find(".todo-title").text().toUpperCase() <
                        $(a).find(".todo-title").text().toUpperCase()
                        ? 1
                        : -1;
                })
                .appendTo(todoTaskList);
        });
    }
    // Sort Descending
    if (sortDesc.length) {
        sortDesc.on("click", function () {
            todoTaskListWrapper
                .find("li")
                .sort(function (a, b) {
                    return $(b).find(".todo-title").text().toUpperCase() >
                        $(a).find(".todo-title").text().toUpperCase()
                        ? 1
                        : -1;
                })
                .appendTo(todoTaskList);
        });
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

    // For chat sidebar on small screen
    if ($(window).width() > 992) {
        if (overlay.hasClass("show")) {
            overlay.removeClass("show");
        }
    }
});

$(window).on("resize", function () {
    // remove show classes from sidebar and overlay if size is > 992
    if ($(window).width() > 992) {
        if ($(".body-content-overlay").hasClass("show")) {
            $(".sidebar-left").removeClass("show");
            $(".body-content-overlay").removeClass("show");
            $(".sidebar-todo-modal").modal("hide");
        }
    }
});
