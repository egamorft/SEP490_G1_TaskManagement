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
                <form id="addTaskFormCalendar" class="row gy-1 pt-75"
                    action="{{ route('add.task.modal', ['slug' => $project->slug, 'board_id' => $board->id]) }}"
                    method="POST">
                    @csrf
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalAddTaskTitle">Task Title</label>
                        <input type="text" id="modalAddTaskTitle" name="modalAddTaskTitle" class="form-control"
                            placeholder="Task Title" data-msg="Please enter your task title" />
                        <span id="error-modalAddTaskTitle" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalAddTaskList">Select Task List</label>
                        <select class="select2 form-select" id="modalAddTaskList" name="modalAddTaskList">
                            @foreach ($taskLists as $list)
                                <option value="{{ $list->id }}">{{ $list->title }}</option>
                            @endforeach
                        </select>
                        <span id="error-modalAddTaskList" style="color: red; display: none"></span>
                    </div>
                    <!-- Limit Selected Options -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddTaskAssignee">Assign to</label>
                        <select class="select2 form-select" id="modalAddTaskAssignee" name="modalAddTaskAssignee">
                            @forelse ($memberAccount as $acc)
                                <option {{ $acc->id == Auth::id() ? 'disabled' : '' }} value="{{ $acc->id }}">
                                    {{ $acc->fullname }} - {{ $acc->email }}
                                    {{ $acc->id == Auth::id() ? '(YOU)' : '' }}
                                </option>
                            @empty
                                <option value="" disabled>No data available</option>
                            @endforelse
                        </select>
                        <span id="error-modalAddTaskAssignee" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="dueDateModal">Duration</label>
                        <input name="modalAddTaskDuration" type="text" id="dueDateModal"
                            class="form-control flatpickr-range-task flatpickr-input active"
                            placeholder="Choose your duration" />
                        <span id="error-modalAddTaskDuration" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddPreviousTask">Task To Finish</label>
                        <select class="select2 form-select" id="modalAddPreviousTask" name="modalAddPreviousTask[]" multiple>
                            @foreach ($tasksInProject as $task)
                                <option value="{{ $task['id'] }}">{{ $task['title'] }}</option>
                            @endforeach
                        </select>
                        <span id="error-modalAddPreviousTask" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTaskDesc">Description</label>
                        <div name="body" id="task-desc" class="border-bottom-0" data-placeholder="Write Your Description"></div>
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
                    <input type="hidden" name="description" id="task-desc-input">
                    <div class="col-12 text-center mt-2 pt-50">
                        <button style="display: none" id="spinnerBtnProjectModalCalendar"
                            class="btn btn-outline-primary waves-effect" type="button" disabled="">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="ms-25 align-middle">Loading...</span>
                        </button>
                        <button type="submit" id="submitBtnProjectModalCalendar" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" id="resetBtnProjectModalCalendar" class="btn btn-outline-secondary" data-bs-dismiss="modal"
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
