<!-- Edit User Modal -->
<div class="modal fade" id="removeTaskList{{ $task->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Remove Task List</h1>
                    <p>Remove task list as per your requirements.</p>
                </div>

                <div class="alert alert-danger" role="alert">
                    <h6 class="alert-heading">Danger! <strong>Remove List <b>{{ $task->name }}</b> and all task in the list</strong></h6>
                    <div class="alert-body">
                        Please ensure you're absolutely certain before proceeding.
                    </div>
                </div>
                <form id="addTaskListForm" class="row gy-1 pt-75"
                    action="{{ route('remove.task.list', ['slug' => $project->slug, 'list_id' => $task->id]) }}" method="POST">
                    @csrf
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-danger me-1">Remove</button>
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
