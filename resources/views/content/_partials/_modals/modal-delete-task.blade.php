<!-- Edit User Modal -->
<div class="modal fade" id="removeTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Confirm to remove Task</h1>
                </div>
                <form id="addTaskListForm" class="row gy-1 pt-75"
                    action="{{ route('remove.task', ['slug' => $project->slug, 'task_id' => $subTask->id]) }}" method="POST">
                    @csrf
                    @method('delete')
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
