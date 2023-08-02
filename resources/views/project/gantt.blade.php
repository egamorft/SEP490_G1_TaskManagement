@extends('layouts/contentLayoutMaster')

@section('content')
    @include('project.header')
	@include('task.gantt')
	@include('task.modal')
@endsection

@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/gantt/dhtmlxgantt_material.css')) }}">
    
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/calendars/fullcalendar.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?v=8.0.3">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-calendar.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <!-- Page js files -->
    {{-- <script src="{{ asset(mix('js/scripts/pages/task-gantt.js')) }}"></script> --}}
    <script src="{{ asset(mix('vendors/js/gantt/dhtmlxgantt.js')) }}"></script>
    {{-- <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script> --}}
    <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
    <style>
        
		.task_groups {
			background-color: orangered !important;
		}

		.task_groups .gantt_task_progress {
			background-color: red;
			opacity: 0.6;
		}
		.gantt_task_row.gantt_selected .weekend {
			background-color: #C0E8FF !important;
		}
    </style>
@endsection

@section('vendor-script')
    <!-- Vendor js files -->
    <script src="{{ asset(mix('vendors/js/calendar/fullcalendar.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/jquery/jquery.min.js')) }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js?v=8.0.3"></script>
@endsection

{{-- @section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/task-detail.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/task-gantt.js')) }}"></script>
@endsection --}}
