@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard')

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

    <!-- projects list start -->
    <section class="app-user-list">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ 10 }}</h3>
                            <span>Doing Projects</span>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content">
                                <i data-feather="fast-forward" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ 20 }}</h3>
                            <span>Done Projects</span>
                        </div>
                        <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                                <i data-feather="check" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ 30 }}</h3>
                            <span>Todo Project</span>
                        </div>
                        <div class="avatar bg-light-warning p-50">
                            <span class="avatar-content">
                                <i data-feather="pause-circle" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{ 10 }}</h3>
                            <span>Rejected Projects</span>
                        </div>
                        <div class="avatar bg-light-danger p-50">
                            <span class="avatar-content">
                                <i data-feather="alert-triangle" class="font-medium-4"></i>
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
                @include('dashboard.all-project')
            </div>
        </div>
        <!-- list and filter end -->
    </section>
    <!-- projects list ends -->
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
