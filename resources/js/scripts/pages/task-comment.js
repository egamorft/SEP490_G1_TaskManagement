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

    var submit_reply = function (parent_comment_id) {
        var comment = $(".comment_replay").val();
		var id = Math.random();
        var html =
            `
				<li class="box_reply row col-12" id="comment_`+id+`">
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
		$("#comment_"+parent_comment_id+" > .result_comment  >.child_replay").append(html);
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
			<li class="box_reply row col-12">
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
							<textarea class="comment_replay" placeholder="Add a comment...">@hieu</textarea>
							<div class="box_post">
								<div class="pull-right">
									<button class="btn btn-secondary cancel-reply" type="button">Cancel</button>
									<button type="button" class="btn btn-primary submit-reply" value="1">Reply</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>`;
        var parent_comment_id = $current.closest("li").attr("id").split('_')[1];

		$("#comment_"+parent_comment_id+" > .result_comment  >.child_replay").append(html);

		$("#comment_"+parent_comment_id+" .cancel-reply").on('click', function() {
			cancel_reply();
		});
		$("#comment_"+parent_comment_id+" .submit-reply").on('click', function() {
			submit_reply(parent_comment_id);
		})
    });
});
