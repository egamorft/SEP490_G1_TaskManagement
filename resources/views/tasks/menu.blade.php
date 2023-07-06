<!-- Right Sidebar starts -->
@include('content._partials._modals.modal-add-new-task')
@include('content._partials._modals.modal-add-new-task-list')

<!-- Right Sidebar ends -->
<!-- Sidebar -->
<div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
    <div class="sidebar-wrapper">
        <div class="card-body add-task d-flex justify-content-center">
            <button type="button" class="btn btn-link border border-primary w-100" data-bs-toggle="modal"
                data-bs-target="#addNewTask">
                Add Task
            </button>
        </div>
        <div class="pt-0 card-body add-task d-flex justify-content-center">
            <button type="button" class="btn btn-link border border-primary w-100" data-bs-toggle="modal"
                data-bs-target="#addNewTaskList">
                Add Task List
            </button>
        </div>
        <div class="card-body pb-0 pt-0">
            <div class="list-group list-group-filters">
                <ul class="todo-task-list media-list" id="todo-task-list">
                    <div class="d-flex align-content-center justify-content-between w-100">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                            <input type="text" class="form-control" id="todo-search" placeholder="Search task"
                                aria-label="Search..." aria-describedby="todo-search" />
                        </div>
                    </div>

                    @foreach ($tasks as $item)
                        <div class="task-list">
                            <p class="mb-2 demo-inline-spacing">
                                <a class="me-1" data-bs-toggle="collapse" href="#collapseUncategorized" role="button"
                                    aria-expanded="false" aria-controls="collapseUncategorized">
                                    {{ $item->name }}
                                </a>
                            </p>
                            @php
                                $subTasksView = [];
                                if (isset($subTasksRelease[$item->id])) {
                                    $subTasksView = $subTasksRelease[$item->id];
                                }
                            @endphp
                            @if (count($subTasksView) > 0)
                                <div class="collapse show" id="collapseUncategorized">
                                    @foreach ($subTasksView as $st)
                                        @php
                                            $currentSubTask = '';
                                            if ($st->id == $subTask->id) {
                                                $currentSubTask = 'bg-light-primary';
                                            }
                                        @endphp
                                        <li class="todo-item {{ $currentSubTask }}">
                                            <a href="{{ $project->slug }}/tasks/0" class="todo-title-wrapper">
                                                <div class="todo-title-area">
                                                    <div class="title-wrapper">
                                                        <i class="text-success" data-feather='check-circle'></i>
                                                        <span class="todo-title d-inline-block text-truncate"
                                                            style="max-width: 150px;">{{ $st->name }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="mt-auto">
        <img src="{{ asset('images/pages/calendar-illustration.png') }}" alt="Calendar illustration"
            class="img-fluid" />
    </div>
</div>
<!-- /Sidebar -->
