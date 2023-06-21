@extends('layouts/contentLayoutMaster')

@section('title', 'User List')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <!-- users list start -->
    <section class="app-user-list">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ $totalAccount }}</h3>
                            <span>Total Users</span>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content">
                                <i data-feather="user" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ $totalActiveAccount }}</h3>
                            <span>Active Users</span>
                        </div>
                        <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                                <i data-feather="user-check" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ $totalInactiveAccount }}</h3>
                            <span>Inactive Users</span>
                        </div>
                        <div class="avatar bg-light-warning p-50">
                            <span class="avatar-content">
                                <i data-feather="user-x" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ $totalBannedAccount }}</h3>
                            <span>Banned Users</span>
                        </div>
                        <div class="avatar bg-light-danger p-50">
                            <span class="avatar-content">
                                <i data-feather="user-plus" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- list and filter start -->
        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title">Search & Filter</h4>
                <div class="row">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div>
            <div class="card-datatable table-responsive pt-0">
                <table class="user-list-table table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($getAllAccount as $key => $account)
                            <tr class="odd" id="row{{ $account->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $account->fullname }}</td>
                                <td>{{ $account->email }}</td>
                                @if ($account->is_admin == 0)
                                    <td>
                                        <span class="text-truncate align-middle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user font-medium-3 text-primary me-50">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                        </span>
                                        User
                                    </td>
                                @else
                                    <td>
                                        <span class="text-truncate align-middle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="feather feather-settings font-medium-3 text-warning me-50">
                                                <circle cx="12" cy="12" r="3"></circle>
                                                <path
                                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                </path>
                                            </svg>
                                        </span>
                                        Admin
                                    </td>
                                @endif
                                <td>
                                    @if ($account->deleted_at != null)
                                        <span class="badge rounded-pill badge-light-danger">Banned</span>
                                    @else
                                        @if ($account->status == 1)
                                            <span class="badge rounded-pill badge-light-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill badge-light-warning">Inactive</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    No data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Modal to add new user starts-->
            <div class="modal modal-slide-in new-user-modal fade" id="add-new-user">
                <div class="modal-dialog">
                    <form class="add-new-user modal-content pt-0" method="POST" action="{{ route('user.create') }}">
                        @csrf
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="alert alert-warning" role="alert">
                                <h6 class="alert-heading">Ensure that password requirements are met</h6>
                                <div class="alert-body fw-normal">Minimum 8 characters long, uppercase & symbol</div>
                            </div>
                            <div class="alert alert-success mb-2" role="alert">
                                <h6 class="alert-heading">Account and password will be sent to user email</h6>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
                                    placeholder="Enter user fullname" name="user-fullname" />
                            </div>
                            <span id="user-fullnameErrorAdd" style="color: red"></span>

                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <input type="text" id="basic-icon-default-email" class="form-control dt-email"
                                    placeholder="your_email@example.com" name="user-email" />
                            </div>
                            <span id="user-emailErrorAdd" style="color: red"></span>

                            <div class="mb-1 form-password-toggle">
                                <label class="form-label" for="user-password">User Password</label>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input class="form-control user-password" type="text" placeholder=".............."
                                        disabled />
                                    <input type="hidden" name="user-password" class="user-password">
                                    <button class="btn btn-outline-primary waves-effect" id="generatePassword"
                                        type="button">Get</button>
                                </div>
                            </div>
                            <span style="color: red" id="user-passwordErrorAdd"></span>

                            <div class="mb-1">
                                <label class="form-label" for="user-role">User Role</label>
                                <select id="user-role" class="select2 form-select" name="user-role">
                                    <option value="0" selected>User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <button hidden id="spinnerBtn" class="btn btn-outline-primary waves-effect" type="button"
                                disabled="">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="ms-25 align-middle">Loading...</span>
                            </button>
                            <button id="submitBtn" type="submit"
                                class="btn btn-primary me-1 data-submit">Submit</button>
                            <button id="resetBtn" type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal to add new user Ends-->

            <!-- Modal to add new user starts-->
            <div class="modal modal-slide-in new-user-modal fade" id="edit-user-modal">
                <div class="modal-dialog">
                    <form id="edit-user-form" class="edit-user-form modal-content pt-0" method="POST"
                        action="{{ route('user.update', ':id') }}">
                        @csrf
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                <input type="text" class="form-control dt-full-name" id="user-fullname"
                                    placeholder="Enter user fullname" name="user-fullname" />
                            </div>
                            <span id="user-fullnameErrorEdit" style="color: red"></span>

                            <div class="mb-1">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <input id="user-email" type="text" id="basic-icon-default-email"
                                    class="form-control dt-email" placeholder="your_email@example.com" name="user-email"
                                    disabled />
                            </div>
                            <span id="user-emailErrorEdit" style="color: red"></span>
                            <div class="mb-1">
                                <label class="form-label" for="user-address">Address</label>
                                <textarea id="user-address" name="user-address" class="form-control" placeholder="Enter user address"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="user-role">User Role</label>
                                <select id="user-role" class="select2 form-select" name="user-role">
                                    <option value="0" selected>User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <button hidden id="spinnerBtn" class="btn btn-outline-primary waves-effect" type="button"
                                disabled="">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="ms-25 align-middle">Loading...</span>
                            </button>
                            <button id="submitBtn" type="submit"
                                class="btn btn-primary me-1 data-submit">Submit</button>
                            <button id="resetBtn" type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal to add new user Ends-->
        </div>
        <!-- list and filter end -->
    </section>
    <!-- users list ends -->
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>
@endsection
