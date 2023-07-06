@include('content._partials._modals.modal-edit-task')
@include('content._partials._modals.modal-delete-task')
<!-- Timeline Card -->
<div class="col task-info bg-white">
    <div class="card card-user-timeline">
        <div class="card-header mb-0">
            <div class="d-flex align-items-center">
                <small>Task Detail</small>
            </div>
            <div class="d-flex align-items-center">
                <div class="file-actions">
                    <div class="dropdown d-inline-block">
                        <i class="font-medium-2 cursor-pointer" data-feather="more-vertical" role="button"
                            id="fileActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </i>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="fileActions">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTask">
                                <i data-feather="edit" class="cursor-pointer me-50"></i>
                                <span class="align-middle">Edit</span>
                            </a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#removeTask">
                                <i data-feather="trash" class="cursor-pointer me-50"></i>
                                <span class="align-middle">Remove</span>
                            </a>
                        </div>
                    </div>
                    <a class="text-dark" href="/projects/{{ $project->slug }}">
                        <i data-feather="x-circle"
                            class="font-medium-2 cursor-pointer d-sm-inline-block d-none me-50"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-0">
            <div class="mt-0">
                <div class="more-info">
                    <h4 class="card-title">{{ $subTask->name }}</h4>
                </div>
            </div>
            <div class="mt-0">
                <div class="more-info">
                    <h6 class="mb-0 text-primary">Doing - Project: {{ $project->name }}</h6>
                    <h6 class="mt-1">From {{ date('D, M d, Y', strtotime($subTask->created_at)) }} - To
                        {{ date('D, M d, Y', strtotime($subTask->due_date)) }}</h6>
                </div>
            </div>
            <hr />

            {{-- Assignee --}}
            <div class="row">
                <div role="button" class="col border-right">
                    <div class="avatar float-start bg-white rounded me-1">
                        <div class="avatar bg-light-danger">
                            <a width="33" height="33">
                                <div class="avatar bg-light-danger">
                                    <div class="avatar-content"><i data-feather='user-plus'></i></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div for="taskAssignee" class="more-info form-label d-block">
                        <small>Assignee</small>
                        <h6 class="mb-0">Click to assign Task</h6>
                    </div>
                    <select class="select2 form-select d-none" id="taskAssignee" name="taskAssignee">
                        <option data-img="{{ asset('images/portrait/small/avatar-s-3.jpg') }}" value="Phill Buffer"
                            selected>
                            Phill Buffer
                        </option>
                        <option data-img="{{ asset('images/portrait/small/avatar-s-1.jpg') }}" value="Chandler Bing">
                            Chandler Bing
                        </option>
                        <option data-img="{{ asset('images/portrait/small/avatar-s-4.jpg') }}" value="Ross Geller">
                            Ross Geller
                        </option>
                        <option data-img="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" value="Monica Geller">
                            Monica Geller
                        </option>
                        <option data-img="{{ asset('images/portrait/small/avatar-s-2.jpg') }}" value="Joey Tribbiani">
                            Joey Tribbiani
                        </option>
                        <option data-img="{{ asset('images/portrait/small/avatar-s-11.jpg') }}" value="Rachel Green">
                            Rachel Green
                        </option>
                    </select>
                </div>
                <div class=" col">
                    <div class="avatar float-start bg-white rounded me-1">
                        <div class="avatar bg-light-danger">
                            <img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar"
                                width="33" height="33" />
                        </div>
                    </div>
                    <div class="more-info">
                        <small>Reviewer</small>
                        <h6 class="mb-0">Tran Ngoc Hieu</h6>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class=" col">
                    <div class="avatar float-start bg-warning rounded me-1">
                        <div class="avatar-content">
                            <i data-feather="square" class="avatar-icon font-medium-3"></i>
                        </div>
                    </div>
                    <div class="more-info">
                        <h6 class="mb-0 text-warning">Waiting for Review</h6>
                        <small>Click to change for Reviewer</small>
                    </div>
                </div>
                <div class=" col border-right">
                    <div class="avatar float-start bg-white rounded me-1">
                        <div class="avatar bg-light-danger">
                            <img src="{{ asset('images/portrait/small/avatar-s-20.jpg') }}" alt="Avatar"
                                width="33" height="33" />
                        </div>
                    </div>
                    <div class="more-info">
                        <small>Assignee</small>
                        <h6 class="mb-0">Tran Ngoc Hieu</h6>
                    </div>
                </div>
                <div class=" col">
                    <div class="avatar float-start bg-success rounded me-1">
                        <div class="avatar-content">
                            <i data-feather="square" class="avatar-icon font-medium-3"></i>
                        </div>
                    </div>
                    <div class="more-info">
                        <h6 class="mb-0 text-success">Done</h6>
                        <small>Click to mark as done</small>
                    </div>
                </div>
                <div class=" col">
                    <div class="avatar float-start bg-white rounded me-1">
                        <div class="avatar bg-light-danger">
                            <img src="{{ asset('images/portrait/small/avatar-s-9.jpg') }}" alt="Avatar"
                                width="33" height="33" />
                        </div>
                    </div>
                    <div class="more-info">
                        <small>Reviewer</small>
                        <h6 class="mb-0">Tran Ngoc Hieu</h6>
                    </div>
                </div>
            </div>

            <hr />
            <div class="mt-2">
                <div class="more-info">
                    <h6 class="mb-2">Task Description</h6>
                    <small>{{ $subTask->description }}</small>
                </div>
            </div>

            <hr />

            <div class="mt-2">
                <div class="more-info">
                    <h6 class="mb-2">Task Result</h6>
                    <small>---</small>
                </div>
            </div>

            <hr />
            <div class="mt-2 chat-application">
                <h6 class="mb-2">Discussion</h6>
                @include('task.comment')
            </div>
        </div>
    </div>
</div>
<!--/ Timeline Card -->
