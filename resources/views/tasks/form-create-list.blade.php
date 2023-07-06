{{-- <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-list-modal">
	<div class="modal-dialog sidebar-lg">
		<div class="modal-content p-0">
			<form id="form-modal-task-list" class="todo-modal needs-validation" action="{{ route('create.task.list', ["slug" => $project->slug]) }}" method="POST">
				@csrf
				<div class="modal-header align-items-center mb-1">
					<h5 class="modal-title">Add Task List</h5>
					<div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
						<i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
					</div>
				</div>
				<div class="modal-body flex-grow-1 pb-sm-0 pb-3">
					<div class="action-tags">
						<div class="mb-1">
							<label for="listTitleAdd" class="form-label">Task List Name</label>
							<input type="text" id="listTitleAdd" name="listTitleAdd"
								class="new-todo-item-title form-control" placeholder="Enter your task list" />
						</div>
					</div>
					<div class="my-1">
						<button type="submit" class="btn btn-primary add-todo-item me-1">Add</button>
						<button type="reset" class="btn btn-outline-secondary add-todo-item"
							data-bs-dismiss="modal">
							Cancel
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div> --}}