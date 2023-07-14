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
            reader.readAsDataURL(input.files[0]);
        }

        submit_form(canvas, function() {
            alert("Submit ok")
        })
    });

    $("#comment-input").keypress(function (e) {
        var canvas = "#formUploadComment";
        if (e.which == 13) {
            $(canvas).submit();
            return false;
        }

        submit_form(canvas, function() {
            alert("Comment thành công");
        })
    });

    function submit_form(canvas, fn = false) {
        $("#formImageUpload").on("submit", fn || function(e) {
            alert("Submit form thành công")
        });
    }

    $('.button-filter-header').on("click", function() {
        if ($('.filter-list').hasClass("hidden")) {
            $('.filter-list').removeClass("hidden");
        } else {
            $('.filter-list').addClass("hidden");
        }
    });
});
