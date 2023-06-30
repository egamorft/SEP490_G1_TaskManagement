<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="role-title">Add New Role</h1>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm1" class="row" action="{{ route('store.role.permissions') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="text" id="modalRoleName" name="modalRoleName" class="form-control modalRoleName"
                            placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name" />
                        <span id="modalRoleNameErrorAdd" style="color: red"></span>
                    </div>
                    <div class="col-12">
                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    @foreach ($permissionsWithRoles as $p)
                                        <tr>
                                            <td class="text-nowrap fw-bolder">{{ $p->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="radio"
                                                            id="Yes{{ $p->slug }}" name="{{ $p->slug }}"
                                                            value="1" />
                                                        <label class="form-check-label" for="Yes{{ $p->slug }}">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="radio"
                                                            id="No{{ $p->slug }}" name="{{ $p->slug }}"
                                                            value="0" checked />
                                                        <label class="form-check-label" for="No{{ $p->slug }}">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                                <span id="{{ $p->slug }}ErrorAdd" style="color: red"></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->
