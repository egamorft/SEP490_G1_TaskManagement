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
        $('.kanban-detail-description > div').append(htmlButton);
        $(".cancel-description").on("click", function() {
            $('.kanban-detail-description .ql-toolbar').remove();
            $('.description-content').html(
                `Đường dẫn : Login → Dashboard → Chọn Project trong side bar mục ‘My Projects’ → Chọn mục
                Calendar → Hiển thị màn chức năng Calendar View để xem danh sách các task trong project
                (ảnh mô tả ‘Calendar View.png’)
                <br>Khi di chuyển Task sang 1 ngày khác trong Calendar thì tiến độ của dự án cũng phải
                cập nhật theo ngày đó`
            );
            $(".description-button-edit").show();
            $('.description-button').remove();
        })
    });
});
