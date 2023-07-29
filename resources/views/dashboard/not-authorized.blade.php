@extends('layouts/contentLayoutMaster')

@section('title', 'FTask - Task Management')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/calendars/fullcalendar.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-calendar.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">You are not authorized! 🔐</h2>
                <p class="mb-2">FTask - Task Management System uses the FPT Education account credentials to access the
                    serves.</p>
                <a class="btn btn-primary mb-1 btn-sm-block" href="{{ url('auth/login-cover') }}">Back to login</a>
            </div>
            <div class="w-100 text-center">
                <img class="img-fluid" src="{{ asset('images/pages/not-authorized.svg') }}" alt="Not authorized page" />
            </div>
        </div>
    </div>
    <!-- / Not authorized-->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/calendar/fullcalendar.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/charts/chart-task-overview.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-calendar-events.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/dashboard-calendar.js')) }}"></script>
@endsection
