<!-- Edit User Modal -->
<div class="modal fade" id="editUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit User Information</h1>
                    <p>Updating user details will receive a privacy audit.</p>
                </div>
                <form id="editUserForm" class="row gy-1 pt-75" action="{{ route('edit.profile.submit') }}"
                    method="POST">
                    @csrf
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserFullname">Full Name</label>
                        <input type="text" id="modalEditUserFullname" name="modalEditUserFullname"
                            class="form-control" placeholder="Enter your fullname" value="{{ Auth::user()->fullname }}"
                            data-msg="Please enter your full name" />
                        <span id="error-modalEditUserFullname" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditEmail">Email</label>
                        <input type="text" id="modalEditEmail" name="modalEditEmail" class="form-control"
                            value="{{ Auth::user()->email }}" placeholder="Enter your email" disabled />
                        <span id="error-modalEditEmail" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserAddress">Address</label>
                        <textarea id="modalEditUserAddress" name="modalEditUserAddress" class="form-control" value="{{ Auth::user()->address }}"
                            placeholder="Enter your address">{{ Auth::user()->address }}</textarea>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Alert-->
@if (Session::has('success'))
    <div id="success-alert" hidden>
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div id="error-alert" hidden>
        {{ Session::get('error') }}
    </div>
@endif
<!-- Alert-->
<!--/ Edit User Modal -->
