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
                    action="{{ route('add.task.modal', ['slug' => $project->slug, 'board_id' => 0]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalAddTaskName">Task Name</label>
                        <input type="text" id="modalAddTaskName" name="taskName" class="form-control"
                            placeholder="Task Name" value="" data-msg="Please enter your list name" />
                        <span id="error-modalAddTaskName" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="select-modalTaskList">Select Task List</label>
                        <select class="select2 form-select" id="task-list" name="taskList">
                            @php
                                $tasklists = [1, 2, 3, 4, 5];
                            @endphp
                            @foreach ($tasklists as $list)
                                <option value="{{ $list }}">{{ 'List  ' . $list }}</option>
                            @endforeach
                        </select>
                        <span id="error-modalTaskList" style="color: red; display: none"></span>
                    </div>
                    <!-- Limit Selected Options -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="select2-limited">Assignee</label>
                        <select class="select2 form-select" id="task-assigned" name="taskAssignee">
                            @php
                                $accounts = [1, 2, 3, 4, 5];
                            @endphp
                            @forelse ($accounts as $acc)
                                <option data-img="{{ asset('images/avatars/H.png') }}" value="{{ $acc }}">
                                    {{ 'Name  ' . $acc }}
                                </option>
                            @empty
                                <option value="" disabled>No data available</option>
                            @endforelse
                        </select>
                        <span id="error-modalTaskAssignee" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="fp-range">Due Date</label>
						<input name="taskDueDate" type="text" id="pd-default" class="form-control pickadate" value="{{ date('j F, Y') }}"  placeholder="18 June, 2020" />
                        <span id="error-modal-duedate" style="color: red; display: none"></span>
                    </div>
                    <div class="mb-1">
                        <label for="attachments" class="form-label">Attachments</label>
                        <input class="form-control file-attachments" name="taskAttachments" type="file"
                            id="modalTaskAttachments" multiple name="taskAttachments" />
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
