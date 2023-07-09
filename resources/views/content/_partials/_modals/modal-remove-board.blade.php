<!-- Edit Board Modal -->
<div class="modal fade" id="removeBoardModal{{ 0 }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-add-new-board">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			<div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Remove Board! </h1>
                    <p>Remove board <b> {{ "Board Name" }} </b>as per your requirements.</p>
                </div>

                <div class="alert alert-danger" role="alert">
                    <h6 class="alert-heading">Danger!</h6>
                    <div class="alert-body">
                        Remove Board and remove all the task in board!
                    </div>
                </div>

                <form id="removeMemberForm" class="row" method="POST" action="{{ route('remove.board') }}">
                    @csrf
                    <div class="text-center mt-2">
                        <input type="hidden" name="board_id" value="{{ 0 }}">
                        <button type="submit" class="btn btn-primary">I'm sure!!</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--/ Edit Board Modal -->
