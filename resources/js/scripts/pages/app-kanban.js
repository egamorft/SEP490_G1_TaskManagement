$(function () {
    "use strict";

    var boards,
        openSidebar = true,
        kanbanWrapper = $(".kanban-wrapper"),
        sidebar = $(".update-item-sidebar"),
        datePicker = $("#due-date"),
        select2 = $(".select2"),
        commentEditor = $(".comment-editor"),
        addNewForm = $(".add-new-board"),
        updateItemSidebar = $(".update-item-sidebar"),
        addNewInput = $(".add-new-board-input"),
        isRtl = $('html').attr('data-textdirection') === 'rtl';

    var assetPath = "../../../app-assets/";
    var csrfToken = $('input[name="csrf-token"]').val();
    var boardId = $('input[name="board_id"]').val();
    var section = $('#section-block');
    if ($("body").attr("data-framework") === "laravel") {
        assetPath = $("body").attr("data-asset-path");
    }

    // Toggle add new input and actions
    addNewInput.toggle();

    // datepicker init
    if (datePicker.length) {
        datePicker.flatpickr({
            monthSelectorType: "static",
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "Y-m-d",
        });
    }

    // select2
    if (select2.length) {
        function renderLabels(option) {
            if (!option.id) {
                return option.text;
            }
            var $badge =
                "<div class='badge " +
                $(option.element).data("color") +
                " rounded-pill'> " +
                option.text +
                "</div>";

            return $badge;
        }

        select2.each(function () {
            var $this = $(this);
            $this.wrap("<div class='position-relative'></div>").select2({
                placeholder: "Select Label",
                dropdownParent: $this.parent(),
                templateResult: renderLabels,
                templateSelection: renderLabels,
                escapeMarkup: function (es) {
                    return es;
                },
            });
        });
    }

    // Comment editor
    if (commentEditor.length) {
        new Quill(".comment-editor", {
            modules: {
                toolbar: ".comment-toolbar",
            },
            placeholder: "Write a Comment... ",
            theme: "snow",
        });
    }

    // Render board dropdown
    function renderBoardDropdown() {
        return (
            "<div class='dropdown'>" +
            feather.icons["more-vertical"].toSvg({
                class: "dropdown-toggle cursor-pointer font-medium-3 me-0",
                id: "board-dropdown",
                "data-bs-toggle": "dropdown",
                "aria-haspopup": "true",
                "aria-expanded": "false",
            }) +
            "<div class='dropdown-menu dropdown-menu-end' aria-labelledby='board-dropdown'>" +
            "<a class='dropdown-item delete-board' href='#'> " +
            feather.icons["trash"].toSvg({
                class: "font-medium-1 align-middle",
            }) +
            "<span class='align-middle ms-25'>Delete</span></a>" +
            "</div>" +
            "</div>"
        );
    }

    // Render item dropdown
    function renderDropdown() {
        return (
            "<div class='dropdown item-dropdown px-1'>" +
            feather.icons["more-vertical"].toSvg({
                class: "dropdown-toggle cursor-pointer me-0 font-medium-1",
                id: "item-dropdown",
                " data-bs-toggle": "dropdown",
                "aria-haspopup": "true",
                "aria-expanded": "false",
            }) +
            "<div class='dropdown-menu dropdown-menu-end' aria-labelledby='item-dropdown'>" +
            "<a class='dropdown-item' href='#'>Copy task link</a>" +
            "<a class='dropdown-item' href='#'>Duplicate task</a>" +
            "<a class='dropdown-item delete-task' href='#'>Delete</a>" +
            "</div>" +
            "</div>"
        );
    }
    // Render header
    function renderHeader(color, text) {
        return (
            "<div class='d-flex justify-content-between flex-wrap align-items-center mb-1'>" +
            "<div class='item-badges'> " +
            "<div class='badge rounded-pill badge-light-" +
            color +
            "'> " +
            text +
            "</div>" +
            "</div>" +
            renderDropdown() +
            "</div>"
        );
    }

    // Render avatar
    function renderAvatar(images, pullUp, margin, members, size) {
        var $transition = pullUp ? " pull-up" : "",
            member = members !== undefined ? members.split(",") : "";

        return images !== undefined
            ? images
                .split(",")
                .map(function (img, index, arr) {
                    var $margin =
                        margin !== undefined && index !== arr.length - 1
                            ? " me-" + margin + ""
                            : "";

                    return (
                        "<li class='avatar kanban-item-avatar" +
                        " " +
                        $transition +
                        " " +
                        $margin +
                        "'" +
                        "data-bs-toggle='tooltip' data-bs-placement='top'" +
                        "title='" +
                        member[index] +
                        "'" +
                        ">" +
                        "<img src='" +
                        assetPath +
                        "images/avatars/" +
                        img +
                        "' alt='Avatar' height='" +
                        size +
                        "'>" +
                        "</li>"
                    );
                })
                .join(" ")
            : "";
    }

    // Render footer
    function renderFooter(attachments, comments, assigned, members) {
        return (
            "<div class='d-flex justify-content-between align-items-center flex-wrap mt-1'>" +
            "<div> <span class='align-middle me-50'>" +
            feather.icons["paperclip"].toSvg({
                class: "font-medium-1 align-middle me-25",
            }) +
            "<span class='attachments align-middle'>" +
            attachments +
            "</span>" +
            "</span> <span class='align-middle'>" +
            feather.icons["message-square"].toSvg({
                class: "font-medium-1 align-middle me-25",
            }) +
            "<span>" +
            comments +
            "</span>" +
            "</span></div>" +
            "<ul class='avatar-group mb-0'>" +
            renderAvatar(assigned, true, 0, members, 28) +
            "</ul>" +
            "</div>"
        );
    }

    // Init kanban
    var kanban = new jKanban({
        element: ".kanban-wrapper",
        gutter: "15px",
        widthBoard: "250px",
        dragItems: true,
        boards: kanbanBoard,
        dragBoards: false,
        addItemButton: true,
        itemAddOptions: {
            enabled: true, // add a button to board for easy item creation
            content: "+ Add New Task", // text or html content of the board button
            class: "kanban-title-button btn btn-default btn-xs", // default class of the button
            footer: false, // position the button on footer
        },
        click: function (el) {
            console.log(el);
            var el = $(el);
            var flag = false;
            var title = el.attr("data-eid")
                ? el.find(".kanban-text").text()
                : el.text(),
                date = el.attr("data-due-date"),
                dateObj = new Date(),
                year = dateObj.getFullYear(),
                dateToUse = date
                    ? date + ", " + year
                    : dateObj.getDate() +
                    " " +
                    dateObj.toLocaleString("en", {
                        month: "long",
                    }) +
                    ", " +
                    year,
                label = el.attr("data-badge-text"),
                avatars = el.attr("data-assigned");

            if (el.find(".kanban-item-avatar").length) {
                el.find(".kanban-item-avatar").on("click", function (e) {
                    e.stopPropagation();
                });
            }
            $(document).on("click", ".item-dropdown", function (e) {
                flag = true;
            });
            setTimeout(function () {
                var elementId = el.attr("data-eid");
                var url = "/&show=task&id=" + elementId;
                var currentUrl = window.location.href.split("/&", (window.location.href).length)[0];
                currentUrl = window.location.href.substring(currentUrl.toString().length, (window.location.href).toString().length);
                if (flag === false) {
                    sidebar.modal("show");
                    if (url != currentUrl) {
                        history.replaceState(null, null, window.location.pathname + url);
                    }
                }
            }, 50);
            sidebar.find(".update-item-form").on("submit", function (e) {
                e.preventDefault();
            });
            sidebar.find("#title").val(title);
            sidebar.find(datePicker).next(".form-control").val(dateToUse);
            sidebar.find(select2).val(label).trigger("change");
            sidebar.find(".assigned").empty();
            sidebar
                .find(".assigned")
                .append(
                    renderAvatar(
                        avatars,
                        false,
                        "50",
                        el.attr("data-members"),
                        32
                    ) +
                    "<li class='avatar avatar-add-member ms-50'>" +
                    "<span class='avatar-content'>" +
                    feather.icons["plus"].toSvg({ class: "avatar-icon" }) +
                    "</li>"
                );
        },
        buttonClick: function (el, taskListId) {
            var addNew = document.createElement("form");
            addNew.setAttribute("class", "new-item-form");
            addNew.innerHTML =
                '<div class="mb-1">' +
                '<textarea class="form-control add-new-item" rows="2" placeholder="Add task title" required></textarea>' +
                "</div>" +
                '<div class="mb-2">' +
                '<button type="submit" class="btn btn-primary btn-sm me-1">Add</button>' +
                '<button type="button" class="btn btn-outline-secondary btn-sm cancel-add-item">Cancel</button>' +
                "</div>";
            kanban.addForm(taskListId, addNew);
            addNew.querySelector("textarea").focus();
            addNew.addEventListener("submit", function (e) {
                e.preventDefault();
                var task_title = e.target[0].value;
                $.ajax({
                    url: '/add-task-kanban',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Include the CSRF token in the headers
                    },
                    data: {
                        task_title: task_title,
                        taskListDataId: taskListId
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
                            var currentBoard = $(
                                ".kanban-board[data-id='" + taskListId + "']"
                            );
                            kanban.addElement(taskListId, {
                                title:
                                    "<span class='kanban-text'>" +
                                    task_title +
                                    "</span>",
                                id:
                                    taskListId +
                                    "-" +
                                    currentBoard.find(".kanban-item").length +
                                    1,
                            });

                            currentBoard
                                .find(".kanban-item:last-child .kanban-text")
                                .before(renderDropdown());
                            addNew.remove();
                        }
                    },
                    error: function (response) {
                        var errMsg = "Sorry! Something went wrong here";
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
            });
            $(document).on("click", ".cancel-add-item", function () {
                $(this).closest(addNew).toggle();
            });
        },
        dragEl: function (el, source) {
            $(el)
                .find(".item-dropdown, .item-dropdown .dropdown-menu.show")
                .removeClass("show");
        },
        dropEl: function (el, target, source, sibling) {
            var task_id = el.getAttribute('data-eid');
            var taskList_id = target.parentNode.getAttribute('data-id');
            $.ajax({
                url: '/move-task-taskList',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken  // Include the CSRF token in the headers
                },
                data: {
                    task_id: task_id,
                    taskList_id: taskList_id
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
                    var errMsg = "Sorry! Something went wrong here";
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

    if (kanbanWrapper.length) {
        new PerfectScrollbar(kanbanWrapper[0]);
    }

    // Render add new inline with boards
    $(".kanban-container").append(addNewForm);

    // Change add item button to flat button
    $.each($(".kanban-title-button"), function () {
        $(this)
            .removeClass()
            .addClass(
                "kanban-title-button btn btn-flat-secondary btn-sm ms-50"
            );
        Waves.init();
        Waves.attach("[class*='btn-flat-']");
    });

    // Makes kanban title editable
    $(document).on("mouseenter", ".kanban-title-board", function () {
        $(this).attr("contenteditable", "true");
    });
    $(document).on("blur", ".kanban-title-board", function () {
        // Get the new edited content
        var newTitle = $(this).text();
        // console.log($(this).parentNode.getAttribute('data-id'));
        var taskListDataId = this.parentNode.parentNode.getAttribute('data-id');
        // Save the new content to a database or update it on the page
        $.ajax({
            url: '/edit-title-taskList',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken  // Include the CSRF token in the headers
            },
            data: {
                newTitle: newTitle,
                taskListDataId: taskListDataId
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
                var errMsg = "Sorry! Something went wrong here";
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

        // Disable editing again
        $(this).attr("contenteditable", "false");
    });

    // Appends delete icon with title
    $.each($(".kanban-board-header"), function () {
        $(this).append(renderBoardDropdown());
    });

    // Deletes Board
    // $(document).on("click", ".delete-board", function () {
    //     var id = $(this).closest(".kanban-board").data("id");
    //     kanban.removeBoard(id);
    // });

    // Delete task
    $(document).on("click", ".dropdown-item.delete-task", function () {
        openSidebar = true;
        var id = $(this).closest(".kanban-item").data("eid");
        kanban.removeElement(id);
    });

    // Open/Cancel add new input
    $(".add-new-btn, .cancel-add-new").on("click", function () {
        addNewInput.toggle();
    });

    // Add new board
    addNewForm.on("submit", function (e) {
        e.preventDefault();
        var $this = $(this),
            value = $this.find(".form-control").val();

        $.ajax({
            url: '/add-taskList',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken  // Include the CSRF token in the headers
            },
            data: {
                title: value,
                board_id: boardId
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
                        location.reload();
                    }, 2000);
                }
            },
            error: function (response) {
                var errMsg = "Sorry! Something went wrong here";
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

        kanban.addBoards([
            {
                id: "taskList_",
                title: value,
            },
        ]);
        // Adds delete board option to new board & updates data-order
        $(".kanban-board:last-child")
            .find(".kanban-board-header")
            .append(renderBoardDropdown());

        // Remove current append new add new form
        addNewInput.val("").css("display", "none");
        $(".kanban-container").append(addNewForm);

        // Update class & init waves
        $.each($(".kanban-title-button"), function () {
            $(this)
                .removeClass()
                .addClass(
                    "kanban-title-button btn btn-flat-secondary btn-sm ms-50"
                );
            Waves.init();
            Waves.attach("[class*='btn-flat-']");
        });
    });

    // Clear comment editor on close
    sidebar.on("hidden.bs.modal", function () {
        sidebar.find(".ql-editor").innerHTML = "";
        sidebar.find(".nav-link-activity").removeClass("active");
        sidebar.find(".tab-pane-activity").removeClass("show active");
        sidebar.find(".nav-link-update").addClass("active");
        sidebar.find(".tab-pane-update").addClass("show active");
    });

    // Re-init tooltip when modal opens(Bootstrap bug)
    sidebar.on("shown.bs.modal", function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    $(".update-item-form").on("submit", function (e) {
        e.preventDefault();
        sidebar.modal("hide");
    });

    // Render custom items
    $.each($(".kanban-item"), function () {
        var $this = $(this),
            $text = "<span class='kanban-text'>" + $this.text() + "</span>";
        if (
            $this.attr("data-badge") !== undefined &&
            $this.attr("data-badge-text") !== undefined
        ) {
            $this.html(
                renderHeader(
                    $this.attr("data-badge"),
                    $this.attr("data-badge-text")
                ) + $text
            );
        }
        if (
            $this.attr("data-comments") !== undefined ||
            $this.attr("data-due-date") !== undefined ||
            $this.attr("data-assigned") !== undefined
        ) {
            $this.append(
                renderFooter(
                    $this.attr("data-attachments"),
                    $this.attr("data-comments"),
                    $this.attr("data-assigned"),
                    $this.attr("data-members")
                )
            );
        }
        if ($this.attr("data-image") !== undefined) {
            $this.html(
                renderHeader(
                    $this.attr("data-badge"),
                    $this.attr("data-badge-text")
                ) +
                "<img class='img-fluid rounded mb-50' src='" +
                assetPath +
                "images/slider/" +
                $this.attr("data-image") +
                "' height='32'/>" +
                $text +
                renderFooter(
                    $this.attr("data-due-date"),
                    $this.attr("data-comments"),
                    $this.attr("data-assigned"),
                    $this.attr("data-members")
                )
            );
        }
        $this.on("mouseenter", function () {
            $this
                .find(".item-dropdown, .item-dropdown .dropdown-menu.show")
                .removeClass("show");
        });
    });

    if (updateItemSidebar.length) {
        updateItemSidebar.on("hidden.bs.modal", function () {
            updateItemSidebar.find(".file-attachments").val("");
        });
    }

    $('.btn-close').on("click", function () {
        var url = window.location.href.split("/&", window.location.href.toString().length)[0];
        history.replaceState(null, null, url);
    });

    $(window).on("load", function () {
        var url = window.location.href.split("/&", window.location.href.toString().length);
        if (url[1] !== undefined) {
            sidebar.modal("show");
        }
    })
});
