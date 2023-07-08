<div class="container">
    <div class="col-md-12" id="fbcomment">
        <div class="header_comment">
            <div class="row">
                <div class="col-md-6 text-left">
                    <span class="count_comment">264235 Comments</span>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <span class="sort_title">Sort by</span>
                    <select class="sort_by">
                        <option>Top</option>
                        <option>Newest</option>
                        <option>Oldest</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="body_comment">
            <div class="row">
                <div class="avatar_comment col-md-1">
                    <div class="chat-avatar">
                        <span class="avatar box-shadow-1 cursor-pointer">
                            <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="24"
                                width="24" />
                        </span>
                    </div>
                </div>
                <form action="{{  }}" method="POST">
                    <div class="box_comment col-md-11">
                        <textarea class="commentar" placeholder="Add a comment..."></textarea>
                        <div class="box_post">
                            <div class="pull-right">
                                <button id="makePost" type="button" class="btn btn-primary" value="1">Post</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <ul id="list_comment" class="col-md-12">
                    <!-- Start List Comment 1 -->
                    <li class="box_result row">
                        <div class="avatar_comment col-md-1">
                            <div class="chat-avatar">
                                <span class="avatar box-shadow-1 cursor-pointer">
                                    <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="avatar"
                                        height="36" width="36" />
                                </span>
                            </div>
                        </div>
                        <div class="result_comment col-md-11">
                            <h6>Trần Ngọc Hiếu</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's.</p>
                            <div class="tools_comment">
                                <a class="like" href="#">Like</a>
                                <span aria-hidden="true"> · </span>
                                <i data-feather='thumbs-up'></i> <span class="count">1</span>
                                <span aria-hidden="true"> · </span>
                                <a class="replay" href="#">Reply</a>
                                <span aria-hidden="true"> · </span>
                                <span>26m</span>
                            </div>
                            <ul class="child_replay">
                                <li class="box_reply row">
                                    <div class="avatar_comment col-md-1">
                                        <div class="chat-avatar">
                                            <span class="avatar box-shadow-1 cursor-pointer">
                                                <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}"
                                                    alt="avatar" height="24" width="24" />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="result_comment col-md-11">
                                        <h6>Viet Phan</h6>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's.</p>
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
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Start List Comment 2 -->
                    <li class="box_result row">
                        <div class="avatar_comment col-md-1">
                            <div class="chat-avatar">
                                <span class="avatar box-shadow-1 cursor-pointer">
                                    <img src="{{ asset('images/portrait/small/avatar-s-7.jpg') }}" alt="avatar"
                                        height="24" width="24" />
                                </span>
                            </div>
                        </div>
                        <div class="result_comment col-md-11">
                            <h6>Minh Duc</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's.</p>
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
                    </li>
                </ul>
                <button class="show_more w-100 btn btn-primary" type="button">Load 42 more comments</button>
                <button class="show_less w-100 btn btn-primary" type="button" style="display:none"><span
                        class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...</button>
            </div>
        </div>
    </div>
</div>
