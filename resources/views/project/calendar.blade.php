@extends('layouts/contentLayoutMaster')

@section('content')
    @include('project.header')
    @include('project.board_header')
    @include('project.board_nav')
    @include('task.calendar')
@endsection


@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/calendars/fullcalendar.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-calendar.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('vendor-script')
    <!-- Vendor js files -->
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/calendar/fullcalendar.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/task-filter.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/task-calendar.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-todo.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/project/board.js')) }}"></script>
@endsection

@php
    $tasks = ['Late', 'Todo', 'Doing', 'Reviewing', 'Done'];
    // dd($project->start_date);
@endphp

<script>
    var tasks = @json($tasks);

    var projectStartDate = new Date("{{ date('Y-m-d', strtotime($project->start_date)) }}").toISOString().substr(0, 10);
    var projectEndDate = new Date("{{ date('Y-m-d', strtotime($project->end_date)) }}").toISOString().substr(0, 10);

    var date = new Date();
    var nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    // prettier-ignore
    var nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date
        .getMonth() + 1, 1);
    // prettier-ignore
    var prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date
        .getMonth() - 1, 1);

    var events = @json($tasksCalendar)
</script>
