<!-- Add Permission Modal -->
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Permission</h1>
                    <p>Permissions you may use and assign to your users.</p>
                </div>
                <form id="addPermissionForm" class="row" method="POST" action="{{ route('create.permissions') }}">
                  @csrf
                    <div class="col-12">
                        <label class="form-label" for="modalPermissionName">Permission Name</label>
                        <input type="text" id="modalPermissionName" name="modalPermissionName" class="form-control modalPermissionName"
                            placeholder="Permission Name" autofocus data-msg="Please enter permission name" />
                            <span id="modalPermissionNameErrorAddPer" style="color: red"></span>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalPermissionSlug">Permission Slug</label>
                        <input type="text" id="modalPermissionSlug" name="modalPermissionSlug" class="form-control modalPermissionSlug"
                            placeholder="Permission Slug" data-msg="Please enter permission slug" />
                            <span id="modalPermissionSlugErrorAddPer" style="color: red"></span>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create Permission</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
