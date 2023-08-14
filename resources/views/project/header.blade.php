<!-- Project Header -->

@if ($disabledProject)
    <div class="alert alert-{{$project->project_status == -1 ? "danger" : "success"}} mt-1 alert-validation-msg" role="alert">
        <div class="alert-body d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-info me-50">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <span><strong>{{ session('projectState') ?? 'Something went wrong' }}</strong></span>
        </div>
    </div>
@endif
<div class="content-header row mb-0 {{ $disabledProject ? 'opacity-50 pointer-events-none' : '' }}">
    <h3 class="mt-1 content-header-left col-md-7 col-12 mb-0">
        <span class="menu-title text-truncate">Project: {{ $project->name }}</span>
    </h3>
    <div class="content-header-right text-md-end col-md-5 col-12 d-md-block d-none">
        <div class="mb-0 breadcrumb-right">
            <div class="d-inline">
                <a type="button"
                    class="{{ $page == 'board' ? 'border-bottom-primary' : '' }} text-primary btn-icon btn btn-round"
                    href="{{ route('view.project.board', ['slug' => $project->slug]) }}">
                    <i data-feather="list" class="font-medium-3 me-50"></i>
                    <span class="fw-bold">Board</span>
                </a>
            </div>
            <div class="d-inline">
                <a type="button"
                    class="{{ $page == 'gantt' ? 'border-bottom-primary' : '' }} text-primary btn-icon btn btn-round"
                    href="{{ route('view.project.gantt', ['slug' => $project->slug]) }}">
                    <i data-feather="trending-up" class="font-medium-3 me-50"></i>
                    <span class="fw-bold">Gantt</span>
                </a>
            </div>
            <div class="d-inline">
                <a type="button"
                    class="{{ $page == 'report' ? 'border-bottom-primary' : '' }} text-primary btn-icon btn btn-round"
                    href="{{ route('view.project.report', ['slug' => $project->slug]) }}">
                    <i data-feather="pie-chart" class="font-medium-3 me-50"></i>
                    <span class="fw-bold">Report</span>
                </a>
            </div>
            <div class="d-inline">
                <a type="button"
                    class="{{ $page == 'settings' ? 'border-bottom-primary' : '' }} text-primary btn-icon btn btn-round"
                    href="{{ route('project.settings', ['slug' => $project->slug]) }}">
                    <i data-feather="settings" class="font-medium-3 me-50"></i>
                    <span class="fw-bold">Settings</span>
                </a>
            </div>
            @can('check-permission', 'evaluate-project')
                <div class="d-inline">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalRejectProject">
                            <i data-feather='x-circle'></i>
                            Reject
                        </a>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalApproveProject">
                            <i data-feather='check-circle'></i>
                            Mark as done
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>
<!--/ Project Header -->
<hr />
@php
    use App\Models\Task;
    use App\Enums\TaskStatus;
    $project_id = $project->id;
    $taskStatusCounts = Task::whereHas('taskList.board.project', function ($query) use ($project_id) {
        $query->where('id', $project_id);
    })
        ->select('status', \DB::raw('COUNT(*) as count'))
        ->groupBy('status')
        ->get();
@endphp
<!-- Left Sidebar reject project starts -->
<div class="modal modal-slide-in sidebar-todo-modal fade" id="modalRejectProject">
    <div class="modal-dialog sidebar-lg" style="left: 0">
        <div class="modal-content p-0">
            <form id="formRejectProject" class="todo-modal" method="POST" action="{{ route('reject.project') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $project->id }}">
                <div class="modal-header align-items-center mb-1">
                    <h5 class="modal-title">Reject "{{ $project->name }}"</h5>
                    <div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
                        <span class="todo-item-favorite cursor-pointer me-75"><i data-feather="star"
                                class="font-medium-2"></i></span>
                        <i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
                    </div>
                </div>
                <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                    <div class="action-tags">
                        <div class="alert alert-danger mb-2" role="alert">
                            <h6 class="alert-heading">You are trying to reject this project?</h6>
                            <div class="alert-body fw-normal">Your action will stop all of activities in project
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <div class="alert-body">
                                @foreach ($taskStatusCounts as $taskStatus)
                                    <li>{{ $taskStatus->count }} tasks are waiting for
                                        {{ TaskStatus::getKey($taskStatus->status) }}</li>
                                @endforeach
                            </div>
                        </div>
                        <div id="rejectProjectEditor"></div>
                        <input type="hidden" name="reason" id="editorReject" value="">
                    </div>
                    <div class="my-1">
                        <button type="submit" class="btn btn-danger add-todo-item me-1 reasonButton">Reject</button>
                        <button type="button" class="btn btn-outline-secondary add-todo-item"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Left Sidebar reject project ends -->

<!-- Right Sidebar approve project starts -->
<div class="modal modal-slide-in sidebar-todo-modal fade" id="modalApproveProject">
    <div class="modal-dialog sidebar-lg">
        <div class="modal-content p-0">
            <form id="formApproveProject" class="todo-modal" method="POST"
                action="{{ route('approve.project') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $project->id }}">
                <div class="modal-header align-items-center mb-1">
                    <h5 class="modal-title">Approve "{{ $project->name }}"</h5>
                    <div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
                        <span class="todo-item-favorite cursor-pointer me-75"><i data-feather="star"
                                class="font-medium-2"></i></span>
                        <i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
                    </div>
                </div>
                <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                    <div class="action-tags">
                        <div class="alert alert-success mb-2" role="alert">
                            <h6 class="alert-heading">You are trying to approve this project?</h6>
                            <div class="alert-body fw-normal">Congratulation for your project succeed
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <div class="alert-body">
                                @foreach ($taskStatusCounts as $taskStatus)
                                    <li>{{ $taskStatus->count }} tasks are waiting for
                                        {{ TaskStatus::getKey($taskStatus->status) }}</li>
                                @endforeach
                            </div>
                        </div>
                        <div id="approveProjectEditor"></div>
                        <input type="hidden" name="reason" id="editorApprove" value="">
                    </div>
                    <div class="my-1">
                        <button type="submit"
                            class="btn btn-success add-todo-item me-1 reasonButton">Approve</button>
                        <button type="button" class="btn btn-outline-secondary add-todo-item"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Right Sidebar approve project ends -->
