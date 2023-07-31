$(document).ready(function () {
    var oldValue = $(".description-content-editor").html();
    var csrfToken = $('[name="csrf-token"]').attr('content');
    var task_id = $('[name="task_id"]').val();
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
                <button type="button" class="btn btn-primary save-description">Save</button>
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
                .html(oldValue.trim());
            $(".description-button-edit").show();
            $(".description-button").remove();
        });

        $(".save-description").on("click", function () {
            var description = $(".ql-editor > p").html();
            var data = {
                _token: csrfToken,
                description: description,
                id: task_id
            };

            // Send the AJAX request
            $.ajax({
                url: '/change-desc',
                method: 'POST',
                data: data,
                success: function (response) {
                    if (response.success) {
                        $(".kanban-detail-description .ql-toolbar").remove();
                        $(".description-content-editor")
                            .removeClass("ql-container")
                            .removeClass("ql-snow")
                            .html(description);
                        $(".description-button-edit").show();
                        $(".description-button").remove();
                    }
                },
                error: function (response) {
                    console.log('something went wrong, try again!');
                }
            });
        });
    });


    //Xử lý comment input khi enter
    $("#comment-input").keypress(function (e) {
        var canvas = "#formUploadComment";
        if (e.which == 13) {
            $(canvas).submit();
            return false;
        }
    });

    $(".button-filter-header").on("click", function () {
        if ($(".filter-list").hasClass("hidden")) {
            $(".filter-list").removeClass("hidden");
        } else {
            $(".filter-list").addClass("hidden");
        }
    });

    $(".add-assignee").on("click", function () {
        var assignTo = $(".user-add-assignee").attr("data-id");
        var input = this;
        var dataImage = $(input).attr("data-img");
        var imageSrc = dataImage.attr("src");

        var thisAssignTo = $(this).closest("li").attr("data-id");
        if (
            $(this)
                .closest(".kanban-detail-user")
                .find(".user-add-assignee")
                .hasClass("user-icon-plus")
        ) {
            $(this)
                .closest(".kanban-detail-user")
                .find(".user-add-assignee")
                .remove();
            $(this).closest(".kanban-detail-user").append(`
				<img class="user-add-assignee" src="${imageSrc}" alt="IMG" data-id=${thisAssignTo} />
			`);
        } else {
            $(this)
                .closest(".kanban-detail-user")
                .find(".user-add-assignee")
                .attr("src", imageSrc);
            $(this)
                .closest(".kanban-detail-user")
                .find(".user-add-assignee")
                .attr("data-id", thisAssignTo);
        }

        if (assignTo !== undefined) {
            $(this)
                .closest(".dropdown-menu-assignee")
                .find("li")
                .each(function () {
                    $(this).find(".add-assignee").removeClass("hidden");
                });
        }
        $(this).addClass("hidden");

        $(this).closest(".dropdown-menu-assignee").addClass("hidden");
    });

    $(".add-reviewer").on("click", function () {
        var reviewBy = $(".user-add-reviewer").attr("data-id");
        var input = this;
        var dataImage = $(input).find("img");
        var imageSrc = dataImage.attr("src");

        var thisReviewBy = $(this).closest("li").attr("data-id");
        if (
            $(this)
                .closest(".kanban-detail-user")
                .find(".user-add-reviewer")
                .hasClass("user-icon-plus")
        ) {
            $(this)
                .closest(".kanban-detail-user")
                .find(".user-add-reviewer")
                .remove();
            $(this).closest(".kanban-detail-user").append(`
				<img class="user-add-reviewer" src="${imageSrc}" alt="IMG" data-id=${thisReviewBy} />
			`);
        } else {
            $(this)
                .closest(".kanban-detail-user")
                .find(".user-add-reviewer")
                .attr("src", imageSrc);
            $(this)
                .closest(".kanban-detail-user")
                .find(".user-add-reviewer")
                .attr("data-id", thisReviewBy);
        }

        if (reviewBy !== undefined) {
            $(this)
                .closest(".dropdown-menu-reviewer")
                .find("li")
                .each(function () {
                    $(this).find(".add-reviewer").removeClass("hidden");
                });
        }

        $(this).addClass("hidden");
        $(this).closest(".dropdown-menu-reviewer").addClass("hidden");
    });

    autoRender();
    renderAddUser();
});

function autoRender() {
    // $(".remove-file-icon").on("click", function () {
    //     $(this).closest(".file-name").remove();
    //     $("input[type=file]").val("");
    // });
}

$(document).mouseup(function (e) {
    click_container(".dropdown-menu-assignee", e);
    click_container(".dropdown-menu-reviewer", e);
    click_container(".select-dropdown-task", e);
});

function click_container(canvas, e) {
    var container_reviewer = $(canvas);
    console.log(!container_reviewer.next(".select2-container"))
    if (
        !container_reviewer.is(e.target) &&
        container_reviewer.has(e.target).length === 0 &&
        !container_reviewer.hasClass("hidden")
    ) {
        container_reviewer.addClass("hidden");
    }
}

function renderAddUser() {
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

    $(".edit-prevtask-wrapper").on("click", function () {
        var prevTask = $(".select-dropdown-task");
        if (prevTask.hasClass("hidden")) {
            prevTask.removeClass("hidden");
        } else {
            prevTask.addClass("hidden");
        }
    });
}

(function (window, document, $) {
    "use strict";
    var select = $(".select2"),
        selectIcons = $(".select2-icons");
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: "100%",
            dropdownParent: $this.parent(),
            class: "add-assignee"
        });
    });

    // Select With Icon
    selectIcons.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            dropdownAutoWidth: true,
            width: "100%",
            minimumResultsForSearch: Infinity,
            dropdownParent: $this.parent(),
            templateResult: iconFormat,
            templateSelection: iconFormat,
            escapeMarkup: function (es) {
                return es;
            },
        });
    });
})(window, document, jQuery);
