<input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
<input type="hidden" name="task_id" value="{{ $taskDetails->id }}">
<div class="mb-2 kanban-detail-header">
    <div class="kanban-detail-title">
        <i data-feather="credit-card" class="custom-title-icon"></i>
        <span class="detail-title-text">
            <strong>
                {{ $taskDetails->title ?? '' }}
            </strong>
        </span>
    </div>
    <div class="mb-1 kanban-detail-status">
        In task list: <span><u id="taskStatus">{{ $taskDetails->taskList->title ?? '' }}</u></span>
    </div>

    <div class="mb-1 kanban-detail-approve">
        <div class="kanban-detail-markdone kanban-detail-stat">
            <div class="kanban-detail-status-title">Done</div>
            <i data-feather="circle" class="icon-done custom-title-icon"></i>
        </div>

        <div class="kanban-detail-reviewing kanban-detail-stat">
            <div class="kanban-detail-status-title">Reviewing</div>
            <i data-feather="circle" class="icon-reviewing custom-title-icon"></i>
        </div>

        <div class="kanban-detail-reject kanban-detail-stat">
            <div class="kanban-detail-status-title">Reject</div>
            <i data-feather="x-circle" class="icon-reject custom-title-icon"></i>
        </div>

        <div class="kanban-detail-done kanban-detail-stat status-done">
            <div class="kanban-detail-status-title">Finish</div>
            <i data-feather="check-circle" class="icon-fully-done custom-title-icon"></i>
        </div>
    </div>
</div>

<div class="mb-2 kanban-detail-progress">
    <div class="mb-1 flex-box">
        <div class="kanban-detail-user">
            <div class="user-title custom-sub-title">Assign to</div>

            @if ($current_role == 'pm' || $current_role == 'supervisor' || $taskDetails->created_by == Auth::id())
                <div class="assignTask">
                    <div class="dropdown-menu-assignee hidden">
                        <select class="select2 form-select" id="modalAssignTo" name="modalAddAssignee">
                            @if (count($memberAccount) <= 0)
                                <option value="0" selected>No Assignee Found</option>
                            @else
                                @foreach ($memberAccount as $acc)
                                    <option class="add-assignee" value="{{ $acc->id }}"
                                        data-img="{{ asset('images/avatars/' . $acc->avatar ?? '') }}"
                                        {{ $acc->id == $taskDetails->assign_to ? 'selected' : '' }}>
                                        {{ $acc->name }} {{ $acc->id == Auth::id() ? '(YOU)' : '' }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            @endif

            @if ($taskDetails->assignTo)
                <img id="imgAssignTo" title="{{ $taskDetails->assignTo->name ?? '' }}" class="user-add-assignee"
                    src="{{ asset('images/avatars/' . $taskDetails->assignTo->avatar ?? '') }}" alt="IMG"
                    data-id="{{ $taskDetails->assign_to }}" />
            @else
                <i data-feather="plus" class="user-add-assignee user-icon-plus"></i>
            @endif

        </div>

        <div class="kanban-detail-user">
            <div class="user-title custom-sub-title">Reviewed by</div>


            @if ($current_role == 'pm' || $current_role == 'supervisor' || $taskDetails->created_by == Auth::id())
                <div class="assignTask">
                    <div class="dropdown-menu-reviewer hidden">
                        <select class="select2 form-select" id="modalReviewer" name="modalAddReviewer">
                            @if (count($allAccInProject) <= 0)
                                <option value="0" selected>No Reviewer Found</option>
                            @else
                                @foreach ($allAccInProject as $acc)
                                    <option class="add-reviewer" value="{{ $acc->id }}"
                                        data-img="{{ asset('images/avatars/' . $acc->avatar ?? '') }}"
                                        {{ $acc->id == $taskDetails->created_by ? 'selected' : '' }}>
                                        {{ $acc->name }} {{ $acc->id == Auth::id() ? '(YOU)' : '' }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            @endif

            @if ($taskDetails->createdBy)
                <img id="imgReviewer" title="{{ $taskDetails->createdBy->name ?? '' }}" class="user-add-reviewer"
                    src="{{ asset('images/avatars/' . $taskDetails->createdBy->avatar ?? '') }}" alt="IMG" />
            @else
                <i data-feather="plus" class="user-add-reviewer user-icon-plus"></i>
            @endif

        </div>

        <div class="kanban-detail-date">
            <div class="date-title custom-sub-title">Task duration</div>
            <div class="flex-box">
                <input name="duration" type="text" id="fp-range"
                    class="form-control flatpickr-range-task flatpickr-input active"
                    placeholder="YYYY-MM-DD to YYYY-MM-DD"
                    value="{{ $taskDetails->start_date }} to {{ $taskDetails->due_date }}">
            </div>
        </div>
    </div>

</div>

<div class="mb-1">
    <div class="kanban-detail-prevtask">
        <div class="date-title custom-sub-title">Task To Finish</div>
        <div class="prev-flex-item">
            <div class="addPrevTask">
                <select class="select2 form-select" id="selectPrevTasks" name="modalAddPreviousTask[]" multiple>
                    @php
                        $prev_tasks_array = json_decode($taskDetails->prev_tasks);
                    @endphp
                    @foreach ($tasksInBoard as $task)
                        <option
                            {{ !empty($prev_tasks_array) && in_array($task->id, $prev_tasks_array) ? 'selected' : '' }}
                            value="{{ $task->id }}">
                            {{ $task->title }}</option>
                    @endforeach
                </select>
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
                <button type="button" class="btn btn-secondary description-button-edit custom-button">Chỉnh
                    sửa</button>
            </div>
        </div>

        <div class="description-content custom-css-content">
            <div class="description-content-editor">
                {!! $taskDetails->description !!}
            </div>
        </div>
    </div>
</div>


<div class="mb-2 kanban-detail-attachment">
    <div class="mb-1">
        <div class="attachment-header flex-box">
            <div class="attachment-title custom-title">
                <i data-feather="paperclip" class="custom-title-icon"></i>
                <span class="custom-title-ml custom-title center">Attachments <small class="text-danger">(Your file
                        must < 2MB && format type as xlsx, docx, png, jpg, pptx, pdf)</small></span>
            </div>
        </div>

        <div class="custom-css-content">
            @if ($taskDetails->attachments)
                @foreach (json_decode($taskDetails->attachments) as $key => $att)
                    @php
                        
                        // Get the file name from the URL
                        $filename = basename($att);
                        
                        // Remove the timestamp portion of the file name
                        $filenameWithoutPrefixAndTimestamp = preg_replace('/^attachment_[0-9]+_/', '', $filename);
                    @endphp
                    <div class="custom-file-content">
                        <div class='file-name' id="file-name-{{ $taskDetails->id }}">
                            <i data-feather="file" class='custom-mini-icon'></i>
                            <a href='{{ $att }}' target='_blank'>
                                <span class='file-item -txt'>{{ $filenameWithoutPrefixAndTimestamp }}</span>
                            </a>
                            <div class="remove-file-icon" data-id="{{ $taskDetails->id }}"
                                data-key="{{ $key }}" onclick="deleteFile(this)">
                                <i class="rm-icon" data-feather="x"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="upload-files mt-1">
                <form action="" id="formImageUpload" method="GET" enctype="multipart/form-data">
                    <input class="form-control" type="file" id="formFileMultiple" multiple
                        accept=".xlsx,.docx,image/png,image/jpeg,.pptx,.pdf" />
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

        <div class="custom-css-content">
            <div id="commentContainer_{{ $taskDetails->id }}">
                @foreach ($comments as $com)
                    @php
                        \Illuminate\Support\Facades\App::setLocale('en');
                        $updated_at = \Carbon\Carbon::parse($com->updated_at);
                        $time_diff = $updated_at->diffForHumans();
                    @endphp
                    <div class="comment-item-wrapper">
                        <img class="comment-item-image"
                            src="{{ asset('images/avatars/' . $com->createdBy->avatar) }}" alt="IMG" />
                        <div class="comment-item-info">
                            <div class="comment-item-info-header">
                                <span class="comment-header-title">{{ $com->createdBy->name }}</span>
                                <span class="comment-header-date-log">About {{ $time_diff }}</span>
                            </div>
                            <div class="comment-text-wrapper">
                                <div class="text-data">
                                    {{ $com->content }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="comment-wrapper">
                <img class="comment-item-image" src="{{ asset('images/avatars/' . Auth::user()->avatar) }}"
                    alt="IMG" />
                <div class="comment-section">
                    <fieldset class="mb-75">
                        <textarea id="content_{{ $taskDetails->id }}" class="form-control commentArea" rows="3"
                            placeholder="Add Comment"></textarea>
                    </fieldset>
                    <button onclick="commentTask(this.id)" id="{{ $taskDetails->id }}"
                        class="btn btn-sm btn-primary waves-effect waves-float waves-light commentButton"
                        type="button">Post
                        comment</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var projectStartDate = new Date("{{ date('Y-m-d', strtotime($project->start_date)) }}").toISOString().substr(0,
        10);
    var projectEndDate = new Date("{{ date('Y-m-d', strtotime($project->end_date)) }}").toISOString().substr(0, 10);
</script>

<script src="{{ URL::asset('js/scripts/pages/app-kanban-detail.js') }}"></script>
<script>
    feather.replace()
</script>
<script>
    $(document).ready(function() {
        var isRtl = $('html').attr('data-textdirection') === 'rtl';
        // Disable the button initially
        $('.commentButton').prop('disabled', true);

        // Comment not null then button enabled
        $('.commentArea').on('input', function() {
            // If the textarea contains text, enable the button
            if ($(this).val().trim().length > 0) {
                $('.commentButton').prop('disabled', false);
            } else {
                // Otherwise, disable the button
                $('.commentButton').prop('disabled', true);
            }
        });

        // FILES
        $("#formFileMultiple").on("change", function(e) {
            e.preventDefault();
            var input = this;

            if (input.files && input.files[0]) {
                var formData = new FormData();

                // Append each selected file to the FormData object
                for (let i = 0; i < input.files.length; i++) {
                    formData.append('files[]', input.files[i]);
                }

                // Add the CSRF token to the FormData object
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', csrfToken);

                var taskId = $('input[name="task_id"]').val();
                formData.append('id', taskId);
                // Send the files to the server using AJAX
                $.ajax({
                    url: '/upload-files',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var html = ``;

                        // Display the selected files
                        for (let i = 0; i < input.files.length; i++) {
                            var fileName = input.files[i].name;
                            // Check if the file is already added
                            if ($('.file-name:contains("' + fileName + '")').length > 0) {
                                continue;
                            }
                            html += `
                <div class='file-name'>
                    <i data-feather="file" class='custom-mini-icon'></i>
                    <span class='file-item -txt'>${fileName}</span>
                    <div class="remove-file-icon">
                        <i class="rm-icon" data-feather="x"></i>
                    </div>
                </div>
            `;
                        }

                        $(".custom-file-content").append(html);
                        autoRender();
                        feather.replace();

                        //Toast
                        toastr['success'](
                            "Success upload file! Wait for few minutes then you can click to download it",
                            'Success!', {
                                showMethod: 'slideDown',
                                hideMethod: 'slideUp',
                                progressBar: true,
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl
                            });
                    },
                    error: function(response) {
                        if (response.status == 404) {
                            //Toast
                            toastr['error'](
                                response.responseJSON.message,
                                'Error!', {
                                    showMethod: 'slideDown',
                                    hideMethod: 'slideUp',
                                    progressBar: true,
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });
                        } else {
                            //Toast
                            toastr['error'](
                                "Opps! Something went wrong, pls try again later...",
                                'Error!', {
                                    showMethod: 'slideDown',
                                    hideMethod: 'slideUp',
                                    progressBar: true,
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });
                        }
                    }
                });
            }
        });

        //PREV TASK - SELECTED
        $('#selectPrevTasks').on('select2:select', function(e) {
            // Get the selected option
            var csrfToken = $('[name="csrf-token"]').attr('content');
            var task_id = $('[name="task_id"]').val();
            var valueSelected = e.params.data.id;

            var data = {
                _token: csrfToken,
                prev_task_id: valueSelected, // Use valueSelected instead of optionSelected
                task_id: task_id
            };

            // Send the AJAX request
            $.ajax({
                url: '/select-prev-task',
                method: 'POST',
                data: data,
                success: function(response) {
                    //Toast
                    toastr['success'](
                        "Success add more previous task!!",
                        'Success!', {
                            showMethod: 'slideDown',
                            hideMethod: 'slideUp',
                            progressBar: true,
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                },
                error: function(xhr, status, error) {
                    console.log("something went wrong");
                }
            });
        });

        //PREV TASK - UNSELECT
        $('#selectPrevTasks').on('select2:unselect', function(e) {
            // Get the unselected option
            var csrfToken = $('[name="csrf-token"]').attr('content');
            var task_id = $('[name="task_id"]').val();
            var valueUnselected = e.params.data.id;

            var data = {
                _token: csrfToken,
                prev_task_id: valueUnselected, // Use valueSelected instead of optionSelected
                task_id: task_id
            };

            // Send the AJAX request
            $.ajax({
                url: '/unselect-prev-task',
                method: 'POST',
                data: data,
                success: function(response) {
                    //Toast
                    toastr['success'](
                        "Success unselect previous task!!",
                        'Success!', {
                            showMethod: 'slideDown',
                            hideMethod: 'slideUp',
                            progressBar: true,
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                },
                error: function(xhr, status, error) {
                    console.log("something went wrong");
                }
            });

        });

        //CHANGE ASSIGNEE
        $('#modalAssignTo').change(function() {
            var selectedUser = $(this).val();
            var csrfToken = $('[name="csrf-token"]').attr('content');
            var task_id = $('[name="task_id"]').val();

            var srcImg = "{{ asset('images/avatars/') }}";

            var data = {
                _token: csrfToken,
                user_id: selectedUser,
                task_id: task_id
            };

            // Send the AJAX request
            $.ajax({
                url: '/change-assignee',
                method: 'POST',
                data: data,
                success: function(response) {
                    var newAvt = srcImg + '/' + response.avatar;
                    var name = response.name;
                    if (response.success) {
                        //Toast
                        $('#imgAssignTo').attr('src', newAvt);

                        toastr['success'](
                            "Success change assignee to " + name + "!!",
                            'Success!', {
                                showMethod: 'slideDown',
                                hideMethod: 'slideUp',
                                progressBar: true,
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl
                            });
                    }
                },
                error: function(xhr, status, error) {
                    console.log("something went wrong");
                }
            });

        });

        //CHANGE REVIEWER
        $('#modalReviewer').change(function() {
            var selectedUser = $(this).val();
            var csrfToken = $('[name="csrf-token"]').attr('content');
            var task_id = $('[name="task_id"]').val();

            var srcImg = "{{ asset('images/avatars/') }}";

            var data = {
                _token: csrfToken,
                user_id: selectedUser,
                task_id: task_id
            };

            // Send the AJAX request
            $.ajax({
                url: '/change-reviewer',
                method: 'POST',
                data: data,
                success: function(response) {
                    var newAvt = srcImg + '/' + response.avatar;
                    var name = response.name;
                    if (response.success) {
                        //Toast
                        $('#imgReviewer').attr('src', newAvt);

                        toastr['success'](
                            "Success change reviewer to " + name + "!!",
                            'Success!', {
                                showMethod: 'slideDown',
                                hideMethod: 'slideUp',
                                progressBar: true,
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl
                            });
                    }
                },
                error: function(xhr, status, error) {
                    console.log("something went wrong");
                }
            });

        });

    });

    //DELETE FILES
    function deleteFile(thisDiv) {
        var isRtl = $('html').attr('data-textdirection') === 'rtl';
        var key = $(thisDiv).data('key');
        var id = $(thisDiv).data('id');
        var csrfToken = $('[name="csrf-token"]').attr('content');

        var data = {
            _token: csrfToken,
            key: key,
            id: id
        };

        // Send the AJAX request
        $.ajax({
            url: '/delete-files',
            method: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    $("#file-name-" + id).remove();
                    $("input[type=file]").val("");
                }
            },
            error: function(response) {
                toastr['error'](response.responseJSON.message,
                    'Error!', {
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        progressBar: true,
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
            }
        });
    }

    //COMMENTS
    function commentTask(id) {
        var csrfToken = $('[name="csrf-token"]').attr('content');

        var created_by = "{{ Auth::user()->name }}";
        var avt = "{{ Auth::user()->avatar }}";
        var content = $('#content_' + id).val();

        if (content != null && content != undefined) {
            var data = {
                _token: csrfToken,
                content: content,
                id: id
            };

            // Send the AJAX request
            $.ajax({
                url: '/comment-task',
                method: 'POST',
                data: data,
                success: function(response) {
                    var newChatMessage = `<div class="comment-item-wrapper">
                <img class="comment-item-image"
                    src="{{ asset('images/avatars/${avt}') }}" alt="IMG" />
                <div class="comment-item-info">
                    <div class="comment-item-info-header">
                        <span class="comment-header-title">${created_by}</span>
                        <span class="comment-header-date-log">Just now</span>
                    </div>
                    <div class="comment-text-wrapper">
                        <div class="text-data">
                            ${content}
                        </div>
                    </div>
                </div>
            </div>`;

                    $('#commentContainer_' + id).append(newChatMessage);

                    // RESET
                    $('#content_' + id).val('');
                    $('.commentButton').prop('disabled', true);

                },
                error: function(xhr, status, error) {
                    console.log("something went wrong");
                }
            });

        } else {
            alert("something went wrong");
        }
    }
</script>
