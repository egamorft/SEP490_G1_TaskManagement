@extends('layouts/contentLayoutMaster')

@section('content')
	@include('project.header')
	@include('project.nav')
	@include('task.calendar')
@endsection


@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/calendars/fullcalendar.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-calendar.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/calendar/fullcalendar.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-calendar-events.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-calendar.js')) }}"></script>
@endsection
