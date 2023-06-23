<!-- Delete Permission Modal -->
<div class="modal fade" id="deletePermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Delete Permission</h1>
                    <p>Delete permission as per your requirements.</p>
                </div>

                <div class="alert alert-warning" role="alert">
                    <h6 class="alert-heading">Warning!</h6>
                    <div class="alert-body">
                        By deleting this permission slug, you might break the system permissions functionality. Please
                        ensure you're
                        absolutely certain before proceeding.
                    </div>
                </div>

                <form id="deletePermissionForm" class="row" method="POST"
                    action="{{ route('remove.permission.role', ':id') }}">
                    @csrf
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--/ Delete Permission Modal -->
