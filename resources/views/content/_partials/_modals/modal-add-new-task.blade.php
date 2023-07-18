<!-- Add New Task Modal -->
<div class="modal fade" id="addNewTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Task</h1>
                </div>
                <form id="addTaskForm" class="row gy-1 pt-75"
                    action="{{ route('add.task.modal', ['slug' => $project->slug, 'board_id' => $board->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalAddTaskName">Task Name</label>
                        <input type="text" id="modalAddTaskName" name="taskName" class="form-control"
                            placeholder="Task Name" data-msg="Please enter your task name" />
                        <span id="error-modalAddTaskName" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="select-modalTaskList">Select Task List</label>
                        <select class="select2 form-select" id="modalAddTaskList" name="taskList">
                            @foreach ($taskLists as $list)
                                <option value="{{ $list->id }}">{{ $list->title }}</option>
                            @endforeach
                        </select>
                        <span id="error-modalTaskList" style="color: red; display: none"></span>
                    </div>
                    <!-- Limit Selected Options -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="select2-limited">Assignee</label>
                        <select class="select2 form-select" id="modalAddTaskAssignee" name="taskAssignee">
                            @forelse ($memberAccount as $acc)
                                <option {{ $acc->id == Auth::id() ? 'disabled' : '' }} value="{{ $acc->id }}">
                                    {{ $acc->fullname }} - {{ $acc->email }}
                                </option>
                            @empty
                                <option value="" disabled>No data available</option>
                            @endforelse
                        </select>
                        <span id="error-modalTaskAssignee" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="fp-range">Due Date</label>
                        <input name="taskDuration" type="text" id="pd-default"
                            class="form-control flatpickr-range-task flatpickr-input active"
                            placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                        <span id="error-modal-duedate" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="select2-limited">Task To Finish</label>
                        <select class="select2 form-select" id="modalAddPreviousTask" name="previousTask" multiple>
                            <option value="task_1">Task 1</option>
                            <option value="task_2">Task 2</option>
                            <option value="task_3">Task 3</option>
                            <option value="task_4">Task 4</option>
                            <option value="task_5">Task 5</option>
                            <option value="task_6">Task 6</option>
                            <option value="no_task_required" selected>No Task Before</option>
                            <option value="" disabled>No data available</option>
                        </select>
                        <span id="error-modalTaskAssignee" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTaskDesc">Description</label>
                        <div id="task-desc" class="border-bottom-0" data-placeholder="Write Your Description"></div>
                        <div class="d-flex justify-content-end desc-toolbar border-top-0">
                            <span class="ql-formats me-0">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-align"></button>
                                <button class="ql-link"></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Dicard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add New Task Modal -->
