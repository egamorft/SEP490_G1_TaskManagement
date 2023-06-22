@extends('layouts/contentLayoutMaster')

@section('title', 'Roles')

@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
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
                            <a href="javascript:void(0);" class="text-body"><i data-feather="copy"
                                    class="font-medium-5"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Role Modal -->
            <div class="modal fade" id="editRoleModal{{ $r->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-hidden="true">
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
                            <form id="addRoleForm" class="row" method="POST" action="">
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
                                                <tr>
                                                    <td class="text-nowrap fw-bolder">
                                                        Project permission access
                                                        <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Allows a full access to the project">
                                                            <i data-feather="info"></i>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="selectAll" />
                                                            <label class="form-check-label" for="selectAll"> Select All
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @foreach ($permissions as $p)
                                                    <tr>
                                                        <td class="text-nowrap fw-bolder">{{ $p->name }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input data-slug="{{ $p->slug }}"
                                                                        data-id="{{ $p->id }}"
                                                                        class="form-check-input permission-radio"
                                                                        type="radio" id="{{ $p->slug }}Yes"
                                                                        name="{{ $p->name }}Option" value="1" />
                                                                    <label class="form-check-label"
                                                                        for="{{ $p->slug }}Yes">
                                                                        Yes
                                                                    </label>
                                                                </div>
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input data-slug="{{ $p->slug }}"
                                                                        data-id="{{ $p->id }}"
                                                                        class="form-check-input permission-radio"
                                                                        type="radio" id="{{ $p->slug }}No"
                                                                        name="{{ $p->name }}Option" value="0" />
                                                                    <label class="form-check-label"
                                                                        for="{{ $p->slug }}No">
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
                            <a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                class="stretched-link text-nowrap add-new-role">
                                <span class="btn btn-primary mb-1">Add New Role</span>
                            </a>
                            <p class="mb-0">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/modal-add-role.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-access-roles.js')) }}"></script>
@endsection
