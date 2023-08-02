@extends('layouts/contentLayoutMaster')

@section('title', 'FTask - Task Management')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section>
        <div class="row match-height">
            @include('dashboard.related-project')
        </div>
        <div class="row match-height">
            @include('dashboard.related-task')
			@include('task.modal')
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    {{-- <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script> --}}

@endsection
@section('page-script')
    {{-- Page js files --}}
	<script>
		var tasks = @json($tasks);
		var taskRoutes = "{{ route('view.task', ['slug' => 'mine', 'task_id' => ':taskId']) }}";

	</script>
    <script src="{{ asset(mix('js/scripts/pages/dashboard-calendar.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/task-detail.js')) }}"></script>
@endsection
