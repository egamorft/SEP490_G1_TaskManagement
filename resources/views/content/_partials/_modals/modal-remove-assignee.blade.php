<!-- Remove member Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="removeAssignee{{ $assignee->id }}"
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Remove Assignee</h1>
                    <p>Remove assignee as per your requirements.</p>
                </div>

                <div class="alert alert-danger" role="alert">
                    <div class="alert-body">
                        Please ensure you're absolutely certain before proceeding.
                    </div>
                </div>

                <form id="removeAssigneeForm" class="row" method="POST" action="{{ route('remove.assignee', ['slug'=>$project->slug, "id"=>$subTask->id]) }}">
                    @csrf
                    <div class="text-center mt-2">
                        <input type="hidden" name="task_id" value="{{ $subTask->id }}">
                        <button type="submit" class="btn btn-primary">I'm sure!!</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--/ Remove member Modal -->
