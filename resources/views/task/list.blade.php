@include('content._partials._modals.modal-edit-task-list')
@include('content._partials._modals.modal-delete-task-list')
<!-- Full list start -->
<section>
    <div class="app-calendar overflow-hidden border">
        <div class="row g-0">
            @include('task.filter')

            <!-- Calendar -->
            <div class="col position-relative bg-white">
                <div class="card shadow-none border-0 mb-0 rounded-0">
                    <div class="card-body pb-0">
                        <div class="todo-app-list">
                            <!-- Todo List starts -->
                            <div class="todo-task-list-wrapper list-group">
                                <ul class="todo-task-list media-list" id="todo-task-list">
                                    @foreach ($tasks as $task)
                                        <div class="task-list card mb-0">
                                            <div class="card-header pl-0 mb-0 demo-inline-spacing">
                                                <a class="me-1 mt-0" data-bs-toggle="collapse" href="#collapseUncategorized"
                                                    role="button" aria-expanded="false"
                                                    aria-controls="collapseUncategorized">
                                                    {{ $task->name }}
                                                </a>
                                                <div class="d-inline-block mt-0 mr-0">
                                                    <a class="mt-0 mr-0 text-dark">
                                                        <i data-feather="edit" class="font-medium-2 cursor-pointer d-sm-inline-block d-none me-50"></i>
                                                    </a>
                                                    <a class="mt-0 mr-0 text-dark">
                                                        <i data-feather="trash" class="font-medium-2 cursor-pointer d-sm-inline-block d-none me-50"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            @php
                                                $subTasksView = [];
                                                if (isset($subTasksRelease[$task->id])) {
                                                    $subTasksView = $subTasksRelease[$task->id];
                                                }
                                            @endphp
                                            
                                            @if (count($subTasksView) > 0)
                                                <div class="collapse show" id="collapseUncategorized">
                                                    @foreach ($subTasksView as $st)
                                                        <li class="todo-item">
                                                            <a href="{{ route("show.task", ["slug" => $project->slug, "task_id" => $st->id]) }}" class="todo-title-wrapper">
                                                                <div class="todo-title-area">
                                                                    <div class="title-wrapper">
                                                                        <i class="text-info" data-feather='circle'></i>
                                                                        <span class="text-dark todo-title">{{ $st->name }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="todo-item-action">
                                                                    <small class="text-nowrap text-muted me-1">---</small>
                                                                    <div class="avatar bg-light-danger">
                                                                        <div class="avatar-content">---</div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </div>  
                                            @else
                                                <div class="no-results">
                                                    <h5>No Items Found</h5>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Todo List ends -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Calendar -->
            <div class="body-content-overlay"></div>
        </div>
    </div>
</section>
<!-- Full list end -->
