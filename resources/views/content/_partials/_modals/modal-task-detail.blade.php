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
</div>

<div class="mb-2 kanban-detail-progress">
    <div class="mb-1 flex-box">
        <div class="kanban-detail-user">
            <div class="user-title custom-sub-title">Assign to</div>

            <div class="assignTask">
                <ul class="dropdown-menu-assignee hidden" style="width: 270px;">
                    <li>
                        <div class="select-header border-bottom">Assign To</div>
                    </li>
                    @foreach ($memberAccount as $acc)
                        <li data-id='{{ $acc->id }}'>
                            <a class='add-assignee dropdown-item text-primary {{ $acc->id == $taskDetails->assign_to ? 'hidden' : '' }}'
                                id="0_assignee">
                                <div class="avatar float-start bg-white rounded me-1">
                                    <div class="avatar bg-light-danger">
                                        <img src="{{ asset('images/avatars/' . $acc->avatar ?? '') }}" alt="Avatar"
                                            width="33" height="33" />
                                    </div>
                                </div>
                                <div class="more-info">
                                    <small>{{ $acc->email }}</small>
                                    <h6 class="mb-0">{{ $acc->name }}</h6>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <li><a class="remove-assignee dropdown-item border-top" data-bs-toggle="modal"
                            data-bs-target="#removeAssignee0" id="0_assignee">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-info">
                                    <h6 class=" text-danger" style="margin-top: 7px;">Remove Assignee</h6>
                                </div>
                            </div>
                        </a></li>
                </ul>
            </div>

            @if ($taskDetails->assignTo)
                <img title="{{ $taskDetails->assignTo->name ?? '' }}" class="user-add-assignee"
                    src="{{ asset('images/avatars/' . $taskDetails->assignTo->avatar ?? '') }}" alt="IMG"
                    data-id="{{ $taskDetails->assign_to }}" />
            @else
                <i data-feather="plus" class="user-add-assignee user-icon-plus"></i>
            @endif

        </div>

        <div class="kanban-detail-user">
            <div class="user-title custom-sub-title">Reviewed by</div>

            <div class="assignTask">
                <ul class="dropdown-menu-reviewer hidden" style="width: 270px;">
                    <li>
                        <div class="select-header border-bottom">Reviewed By</div>
                    </li>
                    @foreach ($memberAccount as $acc)
                        <li data-id='{{ $acc->id }}' class=''>
                            <a class='add-reviewer dropdown-item text-primary {{ $acc->id == $taskDetails->created_by ? 'hidden' : '' }}'
                                id="reviewer">
                                <div class="avatar float-start bg-white rounded me-1">
                                    <div class="avatar bg-light-danger">
                                        <img src="{{ asset('images/avatars/' . $acc->avatar ?? '') }}" alt="Avatar"
                                            width="33" height="33" />
                                    </div>
                                </div>
                                <div class="more-info">
                                    <small>{{ $acc->email }}</small>
                                    <h6 class="mb-0">{{ $acc->name }}</h6>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    @if ($taskDetails->createdBy)
                        <li data-id='{{ $taskDetails->createdBy }}' class='hidden'>
                            <a class="add-reviewer dropdown-item text-primary" id="reviewer">
                                <div class="avatar float-start bg-white rounded me-1">
                                    <div class="avatar bg-light-danger">
                                        <img src="{{ asset('images/avatars/' . $acc->avatar ?? '') }}" alt="Avatar"
                                            width="33" height="33" />
                                    </div>
                                </div>
                                <div class="more-info">
                                    <small>Selected_user@gmail.com</small>
                                    <h6 class="mb-0">Selected User</h6>
                                </div>
                            </a>
                        </li>
                    @endif
                    <li><a class="remove-reviewer dropdown-item border-top" data-bs-toggle="modal"
                            data-bs-target="#removeReviewer" id="reviewer">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-info">
                                    <h6 class=" text-danger" style="margin-top: 7px;">Remove Reviewer</h6>
                                </div>
                            </div>
                        </a></li>
                </ul>
            </div>

            @if ($taskDetails->createdBy)
                <img title="{{ $taskDetails->createdBy->name ?? '' }}" class="user-add-reviewer"
                    src="{{ asset('images/avatars/' . $taskDetails->createdBy->avatar ?? '') }}" alt="IMG" />
            @else
                <i data-feather="plus" class="user-add-reviewer user-icon-plus"></i>
            @endif

        </div>

        <div class="kanban-detail-prevtask">
            <div class="date-title custom-sub-title">Task To Finish</div>
            <div class="flex-box prev-flex-item">
                <div class="prevtask-item">Task 1, Task 2, ...</div>
                <select class="select2 form-select hidden" id="addPrevTask" name="previousTask" multiple>
                    <option value="task_1">Task 1</option>
                    <option value="task_2">Task 2</option>
                    <option value="task_3">Task 3</option>
                    <option value="task_4">Task 4</option>
                    <option value="task_5">Task 5</option>
                    <option value="task_6">Task 6</option>
                    <option value="no_task_required" selected>No Task Before</option>
                    <option value="" disabled>No data available</option>
                </select>
                <div class="edit-prevtask-wrapper">
                    <i class="custom-title-icon icon-edit-prevtask" data-feather="edit-2"></i>
                </div>
            </div>
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

<form method="POST" id="formEditTask"
    action="{{ route('edit.task.modal', ['slug' => $slug, 'board_id' => $board_id, 'task_id' => $taskDetails->id]) }}">
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
</form>


<div class="mb-2 kanban-detail-attachment">
    <div class="mb-1">
        <div class="attachment-header flex-box">
            <div class="attachment-title custom-title">
                <i data-feather="paperclip" class="custom-title-icon"></i>
                <span class="custom-title-ml custom-title center">Attachments</span>
            </div>
        </div>

        <div class="custom-css-content">
            @if ($taskDetails->attachments)
                @foreach (json_decode($taskDetails->attachments) as $att)
                    @php
                        
                        // Get the file name from the URL
                        $filename = basename($att);
                        
                        // Remove the timestamp portion of the file name
                        $filenameWithoutPrefixAndTimestamp = preg_replace('/^attachment_[0-9]+_/', '', $filename);
                    @endphp
                    <div class="custom-file-content">
                        <div class='file-name'>
                            <i data-feather="file" class='custom-mini-icon'></i>
                            <a href='{{ $att }}' target='_blank'>
                                <span class='file-item -txt'>{{ $filenameWithoutPrefixAndTimestamp }}</span>
                            </a>
                            <div class="remove-file-icon">
                                <i class="rm-icon" data-feather="x"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="upload-files mt-1">
                <form action="" id="formImageUpload" method="GET" enctype="multipart/form-data">
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
        // Disable the button initially
        $('.commentButton').prop('disabled', true);

        // Listen for input events on the textarea
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
                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                        console.log(error);
                    }
                });
            }
        });

    });
    //Comments
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
