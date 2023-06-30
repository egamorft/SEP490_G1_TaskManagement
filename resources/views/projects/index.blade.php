
@extends('layouts/contentLayoutMaster')

@section('title', 'Project-' . $project->name)

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/dragula.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-todo.css')) }}">
@endsection

@section('content-sidebar')
@include('projects/app-todo-sidebar')
@endsection

@section('content')
 <!-- Basic tabs start -->
 <section id="basic-tabs-components">
	<div class="row match-height">

		<!-- Tabs with Icon starts -->
		<div class="col-lg-12">
			<div class="card">
				{{-- <div class="card-header">
					<h4 class="card-title">Tab with icon</h4>
				</div> --}}
				<div class="card-body">
					<!-- BEGIN: Header-->
					@include('projects.header')

					<div class="tab-content">
						<div class="tab-pane active" id="taskList" aria-labelledby="taskList-tab" role="tabpanel">
							@include('tasks.list')
						</div>
						<div class="tab-pane" id="gantt" aria-labelledby="gantt-tab" role="tabpanel" >
							<p>
								gantt
							</p>
						</div>
						<div class="tab-pane" id="calendar" aria-labelledby="calendar-tab" role="tabpanel">
							<p>
								calendar
							</p>
						</div>
						<div class="tab-pane" id="report" aria-labelledby="report-tab" role="tabpanel">
							<p>
								report
							</p>
						</div>
						<div class="tab-pane " id="settings" aria-labelledby="settings-tab" role="tabpanel">
							<p>
								settings
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Tabs with Icon ends -->
	</div>
</section>

@endsection

@section('vendor-script')
<!-- vendor js files -->
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/dragula.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-todo.js')) }}"></script>
@endsection
