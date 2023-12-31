@extends('layouts/contentLayoutMaster')

@section('content')
    @include('project.header')
    @include('project.board_header')
    @include('project.board_nav')
    @include('task.kanban')
@endsection

@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/jkanban/jkanban.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-kanban.css')) }}">
@endsection

@section('vendor-script')
    <!-- Vendor js files -->
    <script src="{{ asset(mix('vendors/js/jkanban/jkanban.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
    <script>
        var kanbanBoard = @json($kanbanData);

        var taskListRoutes = "{{ route('view.taskList', ['slug' => $project->slug, 'taskList_id' => ':taskListId']) }}";

        var taskRoutes =
            "{{ route('task.modalsDetail', ['slug' => $project->slug, 'board_id' => $board->id, 'task_id' => ':taskId']) }}";

        var currentRole = "{{ $current_role }}";
    </script>

    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-kanban.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/project/board.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-kanban-detail.js')) }}"></script>
    <script src="{{ asset('js/scripts/components/components-navs.js') }}"></script>
@endsection
