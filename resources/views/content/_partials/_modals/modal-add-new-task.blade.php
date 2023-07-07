<!-- Edit User Modal -->
<div class="modal fade" id="addNewTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Task</h1>
                </div>
                <form id="addTaskForm" class="row gy-1 pt-75" action="{{ route('create.task', ["slug" => $project->slug]) }}" method="POST" enctype="multipart/form-data">
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
							@foreach ($tasks as $task)
								<option value="{{ $task->id }}">{{ $task->name }}</option>
							@endforeach
						</select>
                        <span id="error-modalTaskList" style="color: red; display: none"></span>
                    </div>
                    <!-- Limit Selected Options -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="select2-limited">Assignee</label>
                        <select class="select2 form-select" id="task-assigned" name="taskAssignee">
							@forelse ($accounts as $acc)
								<option data-img="{{ asset('images/portrait/small/' . $acc->avatar) }}"
									value="{{ $acc->id }}">
									{{ $acc->fullname }}
								</option>
							@empty
								<option value="" disabled>No data available</option>
							@endforelse
						</select>
                        <span id="error-modalTaskAssignee" style="color: red; display: none"></span>
                    </div>
					<div class="col-12 col-md-6">
                        <label class="form-label" for="select2-limited">Reviewer</label>
                        <select class="select2 form-select" id="task-reviewer" name="taskReviewer">
							@forelse ($accounts as $acc)
								<option data-img="{{ asset('images/portrait/small/' . $acc->avatar) }}"
									value="{{ $acc->id }}">
									{{ $acc->fullname }}
								</option>
							@empty
								<option value="" disabled>No data available</option>
							@endforelse
						</select>
                        <span id="error-modalTaskReviewer" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="fp-range">Pick your Task duration</label>
                        <input name="duration" type="text" id="fp-range" class="form-control flatpickr-range"
                            placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                        <span id="error-modalDuration" style="color: red; display: none"></span>
                    </div>
					<div class="mb-1">
						<label for="attachments" class="form-label">Attachments</label>
						<input class="form-control file-attachments" name="taskAttachments" type="file" id="modalTaskAttachments" multiple name="taskAttachments"/>
					</div>
                    <div class="col-12">
                        <label class="form-label" for="modalTaskDesc">Description</label>
                        <textarea id="modalTaskDesc" name="taskDescription" class="form-control" value=""
                            placeholder="Enter project description"></textarea>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
