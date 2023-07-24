<!-- Kanban starts -->
<section class="app-kanban-wrapper">
    <div class="row">
        <div class="col-12">
            <form class="add-new-board"
                action="{{ route('add.task.list.modal', ['slug' => $project->slug, 'board_id' => $board->id]) }}">
                <label class="add-new-btn mb-2" for="add-new-board-input">
                    <i class="align-middle" data-feather="plus"></i>
                    <span class="align-middle">Add new</span>
                </label>
                <input type="text" class="form-control add-new-board-input mb-50" placeholder="Add Task Title"
                    id="add-new-board-input" required />
                <div class="mb-1 add-new-board-input">
                    <button type="submit" class="btn btn-primary btn-sm me-75">Add</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm cancel-add-new">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
    <input type="hidden" name="board_id" value="{{ $board->id }}">
    <!-- Kanban content starts -->
    <div id="section-block" class="kanban-wrapper"></div>
    <!-- Kanban content ends -->

    <!-- Kanban Popup starts (Doing) -->
    <div class="modal update-item-sidebar fade" id="targetTaskModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-3 pt-50 task-wrapper">
                    Loading ... 
                </div>
            </div>
        </div>
    </div>
    <!-- Kanban Popup ends -->
</section>
<!-- Kanban ends -->
