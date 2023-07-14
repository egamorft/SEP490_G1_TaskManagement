<!-- Add Board Modal -->
<div class="modal fade" id="addBoardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-add-new-board">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="board-title">Add New Board</h1>
                </div>
                <!-- Add board form -->
                <form id="addBoardForm1" class="row" action="{{ route('add.board', ['slug' => $project->slug]) }}" method="POST">
                    @csrf
					<input type="hidden" value="{{ $project->id }}" name="project_id">
                    <div class="col-12">
                        <label class="form-label" for="modalBoardName">Board Name</label>
                        <input type="text" id="modalBoardName" name="modalBoardName" class="form-control"
                            placeholder="Enter board name" tabindex="-1" data-msg="Please enter board name" />
                        <span id="error-modalBoardName" style="color: red"></span>
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
                <!--/ Add board form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Board Modal -->
