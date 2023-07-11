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
	$tasks = array('Todo','Todo','Doing','Doing','Doing','Ontime','Ontime','Late','Overdue','Overdue','Overdue','Overdue');
@endphp

<script>
	var tasks = @json($tasks);
	console.log(tasks);

    var date = new Date();
    var nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    // prettier-ignore
    var nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date
        .getMonth() + 1, 1);
    // prettier-ignore
    var prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date
        .getMonth() - 1, 1);

    var events = [{
            id: 1,
            url: 'project/ahiiiii',
            title: 'Design Review',
            start: date,
            end: nextDay,
            allDay: false,
            extendedProps: {
                calendar: 'Todo'
            }
        },
        {
            id: 2,
            url: 'project/ahiiiii',
            title: 'Meeting With Client',
            start: new Date('07/11/2023'),
            end: new Date('07/14/2023'),
            allDay: true,
            extendedProps: {
                calendar: 'Todo'
            }
        },
        {
            id: 3,
            url: 'project/ahiiiii',
            title: 'Late Trip',
            allDay: true,
            start: new Date('07/15/2023'),
            end: new Date('07/21/2023'),
            extendedProps: {
                calendar: 'Doing'
            }
        },
        {
            id: 4,
            url: 'project/ahiiiii',
            title: "Doctor's Appointment",
            start: new Date('07/21/2023'),
            end: new Date('07/25/2023'),
            allDay: true,
            extendedProps: {
                calendar: 'Overdue'
            }
        },
        {
            id: 5,
            url: 'project/ahiiiii',
            title: 'Dart Game?',
            start: new Date('07/11/2023'),
            end: new Date('07/19/2023'),
            allDay: true,
            extendedProps: {
                calendar: 'Ontime'
            }
        },
        {
            id: 6,
            url: 'project/ahiiiii',
            title: 'Meditation',
            start: new Date('07/21/2023'),
            end: new Date('07/31/2023'),
            allDay: true,
            extendedProps: {
                calendar: 'Reviewing'
            }
        },
        {
            id: 7,
            url: 'project/ahiiiii',
            title: 'Dinner',
            start: new Date('07/21/2023'),
            end: new Date('08/11/2023'),
            allDay: true,
            extendedProps: {
                calendar: 'Late'
            }
        },
        {
            id: 8,
            url: 'project/ahiiiii',
            title: 'Product Review',
            start: new Date('07/19/2023'),
            end: new Date('07/31/2023'),
            allDay: true,
            extendedProps: {
                calendar: 'Todo'
            }
        },
        {
            id: 9,
            url: 'project/ahiiiii',
            title: 'Monthly Meeting',
            start: nextMonth,
            end: nextMonth,
            allDay: true,
            extendedProps: {
                calendar: 'Todo'
            }
        },
        {
            id: 10,
            url: 'project/ahiiiii',
            title: 'Monthly Checkup',
            start: prevMonth,
            end: prevMonth,
            allDay: true,
            extendedProps: {
                calendar: 'Reviewing'
            }
        },
        {
            id: 10,
            url: 'project/ahiiiii',
            title: 'Monthly Checkup',
            start: prevMonth,
            end: prevMonth,
            allDay: true,
            extendedProps: {
                calendar: 'Reviewing'
            }
        },
        {
            id: 10,
            url: 'project/ahiiiii',
            title: 'Monthly Checkup',
            start: prevMonth,
            end: prevMonth,
            allDay: true,
            extendedProps: {
                calendar: 'Overdue'
            }
        }
    ];

</script>


