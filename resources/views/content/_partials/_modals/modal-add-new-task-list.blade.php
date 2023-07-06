<!-- Edit User Modal -->
<div class="modal fade" id="addNewTaskList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Task List</h1>
                </div>
                <form id="addTaskListForm" class="row gy-1 pt-75"
                    action="{{ route('create.task.list', ['slug' => $project->slug]) }}" method="POST">
                    @csrf
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalAddTaskListName">Task List Name</label>
                        <input type="text" id="modalAddTaskListName" name="taskListTitle" class="form-control"
                            placeholder="Task List Name" value="" data-msg="Please enter your list name" />
                        <span id="error-modalAddTaskListName" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalTaskListDesc">Description</label>
                        <textarea id="modalTaskListDesc" name="taskListDescription" class="form-control" value=""
                            placeholder="Enter task list description"></textarea>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Add</button>
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
