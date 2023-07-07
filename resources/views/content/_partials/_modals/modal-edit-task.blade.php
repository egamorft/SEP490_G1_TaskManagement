<!-- Edit User Modal -->
<div class="modal fade" id="editTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Task</h1>
                </div>
                <form id="addTaskForm" class="row gy-1 pt-75" action="{{ route('edit.task', ["slug" => $project->slug, 'task_id' => 0]) }}" method="POST">
                    @csrf
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalEditTaskName">Task Name</label>
                        <input type="text" id="modalEditTaskName" name="modalEditTaskName" class="form-control"
                            placeholder="Task Name" value="{{ $subTask->name }}" data-msg="Please enter your list name" />
                        <span id="error-modalEditTaskName" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="select-modalTaskList">Select Task List</label>
                        <select class="select2 form-select" id="task-list" name="taskList">
							@foreach ($tasks as $task)
								<option value="{{ $task->id }}" {{ $subTask->task_id == $task->id ? "selected" : "" }}>{{ $task->name }}</option>
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
									value="{{ $acc->id }}" {{ $subTask->assign_to == $acc->id ? "selected" : "" }}>
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
									value="{{ $acc->id }}" {{ $subTask->review_by == $acc->id ? "selected" : "" }}>
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
                        <input name="modalDuration" type="text" id="fp-range" class="form-control flatpickr-range"
                            placeholder="YYYY-MM-DD to YYYY-MM-DD" value="{{ $subTask->start_date . " to " . $subTask->due_date }}"/>
                        <span id="error-modalDuration" style="color: red; display: none"></span>
                    </div>
					<div class="mb-1">
						<label for="attachments" class="form-label">Attachments</label>
						<input class="form-control file-attachments" type="file" id="modalTaskAttachments" multiple value="{{ $subTask->attachment }}" />
					</div>
                    <div class="col-12">
                        <label class="form-label" for="modalTaskDesc">Description</label>
                        <textarea id="modalTaskDesc" name="modalTaskDesc" class="form-control"
                            placeholder="Enter project description">{{ $subTask->description }}</textarea>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Save</button>
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
