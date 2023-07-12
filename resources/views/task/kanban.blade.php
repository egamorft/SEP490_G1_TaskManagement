<!-- Kanban starts -->
<section class="app-kanban-wrapper">
    <div class="row">
        <div class="col-12">
            <form class="add-new-board"
                action="{{ route('add.task.list.modal', ['slug' => $project->slug, 'board_id' => $board->id]) }}">
                <label class="add-new-btn mb-2" for="add-new-board-input">
                    <i class="align-middle" data-feather="plus"></i>
                    <span class="align-middle">Add new</span>
                </label>
                <input type="text" class="form-control add-new-board-input mb-50" placeholder="Add Task Title"
                    id="add-new-board-input" required />
                <div class="mb-1 add-new-board-input">
                    <button type="submit" class="btn btn-primary btn-sm me-75">Add</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm cancel-add-new">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
    <input type="hidden" name="board_id" value="{{ $board->id }}">
    <!-- Kanban content starts -->
    <div id="section-block" class="kanban-wrapper"></div>
    <!-- Kanban content ends -->

    <!-- Kanban Popup starts (Doing) -->
    <div class="modal update-item-sidebar fade" id="addNewProject" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-3 pt-50">
                    <div class="mb-2 kanban-detail-header">
                        <div class="kanban-detail-title">
                            <i data-feather="credit-card" class="custom-title-icon"></i>
                            <span class="detail-title-text">Code màn chức năng view BE</span>
                        </div>
                        <div class="mb-1 kanban-detail-status">
                            trong danh sách <span><u>Đang làm</u></span>
                        </div>
                    </div>

                    <form method="POST" id="formEditTask"
                        action="{{ route('edit.task.modal', ['slug' => $project->slug, 'board_id' => 0, 'task_id' => 0]) }}">
                        <div class="mb-2 kanban-detail-progress">
                            <div class="mb-1 flex-box">
                                <div class="kanban-detail-user">
                                    <div class="user-title custom-sub-title">Thành viên</div>

                                    <img class="user-add-assignee"
                                        src="data:image/jpeg;base64,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"
                                        alt="IMG" />
                                    <button href="#" class="user-add-assignee">
                                        <i data-feather="plus"></i>
                                    </button>
                                </div>

                                <div class="kanban-detail-noti">
                                    <div class="noti-title custom-sub-title">Thông báo</div>
                                    <button class="btn btn-secondary noti-button-action custom-button">
                                        <i data-feather="eye"></i>
                                        <span class="btn-text">Theo dõi</span>
                                    </button>
                                </div>

                                <div class="kanban-detail-date">
                                    <div class="date-title custom-sub-title">Ngày</div>
                                    <div class="flex-box">
                                        <input class="form-check-input checkbox-finish-task" type="checkbox"
                                            value="" id="flexCheckChecked">
                                        <input name="duration" type="text" id="fp-range"
                                            class="form-control flatpickr-range"
                                            placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 kanban-detail-description">
                            <div class="mb-1">
                                <div class="description-header flex-box">
                                    <div class="description-title custom-title">
                                        <i data-feather="align-left" class="custom-title-icon"></i>
                                        <span class="custom-title-ml custom-title center">Mô tả</span>
                                    </div>
                                    <div class="description-side">
                                        <button type="button"
                                            class="btn btn-secondary description-button-edit custom-button">Chỉnh
                                            sửa</button>
                                    </div>
                                </div>

                                <div class="description-content custom-css-content">
                                    <div class="description-content-editor">
                                        Đường dẫn : Login → Dashboard → Chọn Project trong side bar mục ‘My Projects’ →
                                        Chọn mục
                                        Calendar → Hiển thị màn chức năng Calendar View để xem danh sách các task trong
                                        project
                                        (ảnh mô tả ‘Calendar View.png’)
                                        <br />Khi di chuyển Task sang 1 ngày khác trong Calendar thì tiến độ của dự án
                                        cũng phải
                                        cập nhật theo ngày đó
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="mb-2 kanban-detail-attachment">
                        <div class="mb-1">
                            <div class="attachment-header flex-box">
                                <div class="attachment-title custom-title">
                                    <i data-feather="paperclip" class="custom-title-icon"></i>
                                    <span class="custom-title-ml custom-title center">Tệp đính kèm</span>
                                </div>
                            </div>

                            <div class="custom-css-content">
                                <img src="" alt="No image" />

                                <div class="upload-files mt-1">
                                    <form action="" id="formImageUpload" method="GET"
                                        enctype="multipart/form-data">
                                        <input class="form-control" type="file" id="formFileMultiple" multiple />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 kanban-detail-attachment">
                        <div class="mb-1">
                            <div class="attachment-header flex-box">
                                <div class="attachment-title custom-title">
                                    <i data-feather="activity" class="custom-title-icon"></i>
                                    <span class="custom-title-ml custom-title center">Hoạt động</span>
                                </div>
                            </div>

                            <div>
                                <form action="" method="GET" class="formUploadComment">
                                    <div class="comment-item-wrapper">
                                        <img class="comment-item-image"
                                            src="data:image/jpeg;base64,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"
                                            alt="IMG" />
                                        <input type="text" id="comment-input" name="commentInput"
                                            class="form-control" placeholder="Write your comment here" value=""
                                            data-msg="Please enter your comment" />
                                    </div>

                                    <div class="comment-item-wrapper">
                                        <img class="comment-item-image"
                                            src="data:image/jpeg;base64,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"
                                            alt="IMG" />
                                        <div class="comment-item-info">
                                            <div class="comment-item-info-header">
                                                <span class="comment-header-title">Phan Tuấn Việt</span>
                                                <span class="comment-header-date-log">About 1 phút trước</span>
                                            </div>
                                            <input type="text" id="comment-input" name="commentInput"
                                                class="form-control" placeholder="Write your comment here"
                                                value="Test thử xem input được chưa"
                                                data-msg="Please enter your comment" disabled />
                                            <a class="confirm-delete-task js-confirm-delete-task">Xóa</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kanban Popup ends -->
</section>
<!-- Kanban ends -->
