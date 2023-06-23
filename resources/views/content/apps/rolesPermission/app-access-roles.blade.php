@extends('layouts/contentLayoutMaster')

@section('title', 'Roles')

@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection

@section('content')
    <h3>Roles List</h3>
    <p class="mb-2">
        A role provided access to predefined menus and features so that depending <br />
        on assigned role you can have access to what you need
    </p>

    <!-- Role cards -->
    <div class="row">
        @forelse ($roles as $r)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            @foreach ($rolesWithCount as $rwc)
                                @if ($rwc->name == $r->name)
                                    <span>Total {{ $rwc->accounts_count }} users</span>
                                @else
                                @endif
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder text-uppercase">{{ $r->name }}</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal"
                                    data-bs-target="#editRoleModal{{ $r->id }}" data-id="{{ $r->id }}">
                                    <small class="fw-bolder">Edit Role</small>
                                </a>
                            </div>
                            @if ($r->name == 'pm' || $r->name == 'dev' || $r->name == 'supervisor')
                                <button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect"
                                    data-bs-trigger="hover" data-bs-toggle="popover" data-bs-placement="top"
                                    data-bs-container="body"
                                    data-bs-content="This role will help user to the develop the project."
                                    data-bs-original-title="Core role" aria-describedby="popover921362">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            @else
                                <a data-id="{{ $r->id }}" class="text-body delete-role"><i data-feather="trash-2"
                                        class="font-medium-5"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
            <!-- Edit Role Modal -->
            <div class="modal fade" id="editRoleModal{{ $r->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5 pb-5">
                            <div class="text-center mb-4">
                                <h1 class="role-title">Edit Role {{ $r->name }}</h1>
                                <p>Set role permissions</p>
                            </div>
                            <!-- Edit role form -->
                            <form id="addRoleForm" class="row" method="POST"
                                action="{{ route('update.role.permissions', $r->id) }}">
                                @csrf
                                <div class="col-12">
                                    <label class="form-label" for="modalRoleName">Role Name</label>
                                    <input type="text" id="modalRoleName" name="modalRoleName" class="form-control"
                                        value="{{ $r->name }}" readonly />
                                </div>
                                <div class="col-12">
                                    <h4 class="mt-2 pt-50">User's role Permissions</h4>
                                    <!-- Permission table -->
                                    <div class="table-responsive">
                                        <table class="table table-flush-spacing">
                                            <tbody>
                                                @foreach ($permissions as $p)
                                                    <tr>
                                                        <td class="text-nowrap fw-bolder">{{ $p->name }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input" type="radio"
                                                                        id="{{ $p->slug }}Yes{{ $r->id }}"
                                                                        name="{{ $p->slug }}" value="1"
                                                                        @if (in_array($p->id, $rolePermissions[$r->id])) checked @endif />
                                                                    <label class="form-check-label"
                                                                        for="{{ $p->slug }}Yes{{ $r->id }}">
                                                                        Yes
                                                                    </label>
                                                                </div>
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input" type="radio"
                                                                        id="{{ $p->slug }}No{{ $r->id }}"
                                                                        name="{{ $p->slug }}" value="0"
                                                                        @if (!in_array($p->id, $rolePermissions[$r->id])) checked @endif />
                                                                    <label class="form-check-label"
                                                                        for="{{ $p->slug }}No{{ $r->id }}">
                                                                        No
                                                                    </label>
                                                                </div>
                                                            </div>
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
                            <!--/ Edit role form -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Edit Role Modal -->
        @empty

        @endforelse
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end justify-content-center h-100">
                            <img src="{{ asset('images/illustration/faq-illustrations.svg') }}" class="img-fluid mt-2"
                                alt="Image" width="85" />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a href="#" data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                class="stretched-link text-nowrap add-new-role">
                                <span class="btn btn-primary mb-1">Add New Role</span>
                            </a>
                            <p class="mb-0">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3>Permissions List</h3>
        <p>Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>

        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-permissions table">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Assigned To</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $key => $per)
                            <tr id="row{{ $per->id }}">
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $per->name }}
                                </td>
                                <td>
                                    {{ $per->slug }}
                                </td>
                                <td>
                                    @foreach ($per->roles as $role)
                                        <span style="display: none" class="roleNames">{{ $role->name }}</span>
                                        @switch($role->name)
                                            @case('pm')
                                                <span class="badge rounded-pill badge-light-primary">{{ $role->name }}</span>
                                            @break

                                            @case('dev')
                                                <span class="badge rounded-pill badge-light-success">{{ $role->name }}</span>
                                            @break

                                            @case('supervisor')
                                                <span class="badge rounded-pill badge-light-warning">{{ $role->name }}</span>
                                            @break

                                            @case('ba')
                                                <span class="badge rounded-pill badge-light-info">{{ $role->name }}</span>
                                            @break

                                            @case('tester')
                                                <span class="badge rounded-pill badge-light-danger">{{ $role->name }}</span>
                                            @break

                                            @default
                                                <span class="badge rounded-pill badge-light-dark">{{ $role->name }}</span>
                                        @endswitch
                                    @endforeach
                                </td>
                                <td></td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No permissions found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Permission Table -->

            @include('content._partials._modals.modal-add-permission')
            @include('content._partials._modals.modal-edit-permission')
            @include('content._partials._modals.modal-delete-permission')
        </div>
        <!--/ Role cards -->

        @include('content._partials._modals.modal-add-role')
    @endsection

    @section('vendor-script')
        <!-- Vendor js files -->
        <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap5.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    @endsection
    @section('page-script')
        <!-- Page js files -->
        <script src="{{ asset(mix('js/scripts/pages/modal-add-role.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/pages/app-access-roles.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/pages/modal-add-permission.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/pages/modal-edit-permission.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/pages/app-access-permission.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/components/components-popovers.js')) }}"></script>
    @endsection
