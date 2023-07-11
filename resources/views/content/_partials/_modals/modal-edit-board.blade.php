<!-- Edit Board Modal -->
<div class="modal fade" id="editBoard{{ $board->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-add-new-board">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="board-title">Edit Board: {{ $board->title }}</h1>
                </div>
                <!-- Edit board form -->
                <form id="editBoardForm" class="row" action="{{ route('edit.board', ['slug' => $project->slug, 'id' => $board->id]) }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="modalBoardTitleEdit">Board Title</label>
                        <input type="text" id="modalBoardTitleEdit" name="modalBoardTitleEdit" class="form-control modalBoardTitleEdit"
                            placeholder="Enter board title" tabindex="-1" data-msg="Please enter board title" value="{{ $board->title }}"/>
                        <span id="error-modalBoardTitleEdit" style="color: red"></span>
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
                <!--/ Edit board form -->
            </div>
        </div>
    </div>
</div>
<!--/ Edit Board Modal -->
