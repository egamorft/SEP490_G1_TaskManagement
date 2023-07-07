/*=========================================================================================
    File Name: task-list.js
    Description: dashboard ecommerce page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function () {
    "use strict";

    var post_btn = $("#makePost");

    var submit_comment = function () {
        var comment = $(".commentar").val();
        var html =
            `
			<li class="box_result row">
				<div class="avatar_comment col-md-1">
					<div class="chat-avatar">
						<span class="avatar box-shadow-1 cursor-pointer">
							<img src="//localhost:3000/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36">
						</span>
					</div>
				</div>
				<div class="result_comment col-md-11">
					<h6>Trần Ngọc Hiếu</h6>
					<p>` +comment +
            		`</p>
					<div class="tools_comment">
					<a class="like" href="#">Like</a>
					<span aria-hidden="true"> · </span>
					<i data-feather='thumbs-up'></i> <span class="count">1</span>
					<span aria-hidden="true"> · </span>
					<a class="replay" href="#">Reply</a>
					<span aria-hidden="true"> · </span>
					<span>26m</span>
				</div>
					<ul class="child_replay"></ul>
				</div>
			</li>`;
        $("#list_comment").prepend(html);
        $(".commentar").val("");
    };

    var submit_reply = function () {
        var comment_replay = $(".comment_replay").val();
        el = document.createElement("li");
        el.className = "box_reply row";
        el.innerHTML =
            '<div class="avatar_comment col-md-1">' +
            '<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>' +
            "</div>" +
            '<div class="result_comment col-md-11">' +
            "<h4>Anonimous</h4>" +
            "<p>" +
            comment_replay +
            "</p>" +
            '<div class="tools_comment">' +
            '<a class="like" href="#">Like</a><span aria-hidden="true"> · </span>' +
            '<i class="fa fa-thumbs-o-up"></i> <span class="count">0</span>' +
            '<span aria-hidden="true"> · </span>' +
            '<a class="replay" href="#">Reply</a><span aria-hidden="true"> · </span>' +
            "<span>1m</span>" +
            "</div>" +
            '<ul class="child_replay"></ul>' +
            "</div>";
        $current.closest("li").find(".child_replay").prepend(el);
        $(".comment_replay").val("");
        cancel_reply();
    };

    var cancel_reply = function () {
        $(".reply_comment").remove();
    };

    post_btn.on("click", function () {
        submit_comment();
    });

    $(".show_more").on("click", function (e) {
        $(".show_more").hide();
        $(".show_less").show();
    });

    $("#list_comment .like").on("click", function (e) {
        var $current = $(this);
        var x = $current.closest("div").find(".like").text().trim();
        var y = parseInt($current.closest("div").find(".count").text().trim());

        if (x === "Like") {
            $current.closest("div").find(".like").text("Unlike");
            $current
                .closest("div")
                .find(".count")
                .text(y + 1);
        } else if (x === "Unlike") {
            $current.closest("div").find(".like").text("Like");
            $current
                .closest("div")
                .find(".count")
                .text(y - 1);
        } else {
            var replay = $current.closest("div").find(".like").text("Like");
            $current
                .closest("div")
                .find(".count")
                .text(y - 1);
        }
    });

    $("#list_comment .replay").on("click", function (e) {
        cancel_reply();
		var $current = $(this);
        var html = `
			<li class="box_reply row">
				<div class="col-md-12 reply_comment">
					<div class="row">
						<div class="avatar_comment col-md-1">
							<div class="chat-avatar">
								<span class="avatar box-shadow-1 cursor-pointer">
									<img src="//localhost:3000/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36">
								</span>
							</div>
						</div>
						<div class="box_comment col-md-11">
							<textarea class="commentar" placeholder="Add a comment..."></textarea>
							<div class="box_post">
								<div class="pull-right">
									<button class="btn btn-secondary" type="button">Cancel</button>
									<button type="button" class="btn btn-primary" value="1">Reply</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>`;
        $current.closest("li").find(".child_replay").prepend(html);
    });
});
