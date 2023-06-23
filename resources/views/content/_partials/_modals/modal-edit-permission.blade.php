<!-- Edit Permission Modal -->
<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Permission</h1>
                    <p>Edit permission as per your requirements.</p>
                </div>

                <div class="alert alert-warning" role="alert">
                    <h6 class="alert-heading">Warning!</h6>
                    <div class="alert-body">
                        By editing the permission slug, you might break the system permissions functionality. Please
                        ensure you're
                        absolutely certain before proceeding.
                    </div>
                </div>

                <form id="editPermissionForm" class="row" method="POST"
                    action="{{ route('edit.permissions', ':id') }}">
                    @csrf
                    <div class="col-md-8 mx-auto">
                        <div class="form-group text-center">
                            <label class="form-label" for="modalPermissionName">Permission Name</label>
                            <input type="text" id="modalPermissionName" name="modalPermissionName"
                                class="form-control modalPermissionName" placeholder="Enter a permission name"
                                tabindex="-1" data-msg="Please enter permission name" />
                            <span id="modalPermissionNameErrorEditPer" style="color: red"></span>
                        </div>
                        <div class="form-group text-center">
                            <label class="form-label" for="modalPermissionSlug">Permission Slug</label>
                            <input type="text" id="modalPermissionSlug" name="modalPermissionSlug"
                                class="form-control modalPermissionSlug" placeholder="Enter a permission slug"
                                tabindex="-1" data-msg="Please enter permission slug" />
                            <span id="modalPermissionSlugErrorEditPer" style="color: red"></span>
                        </div>
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--/ Edit Permission Modal -->
