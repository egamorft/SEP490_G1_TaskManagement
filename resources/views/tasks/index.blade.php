@extends('layouts/contentLayoutMaster')

@section('title', 'Project - ' . $project->name)

@section('content')
@include('projects.nav')
<div class="row">
	<div class="col-xl-12 col-md-8 col-12">
		<section>
			<div class="app-calendar overflow-hidden border">
				<div class="row g-0">
					@include('tasks.menu')
					@include('tasks.info')
					<div class="body-content-overlay"></div>
				</div>
			</div>
			<!-- Right Sidebar starts -->
			<div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
				<div class="modal-dialog sidebar-lg">
					<div class="modal-content p-0">
						<form id="form-modal-todo-a" class="todo-modal needs-validation" action="{{ route('task.create', ["slug" => $project->slug]) }}" method="POST">
							@csrf
							<div class="modal-header align-items-center mb-1">
								<h5 class="modal-title">Add Task</h5>
								<div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
									<i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
								</div>
							</div>
							<div class="modal-body flex-grow-1 pb-sm-0 pb-3">
								<div class="action-tags">
									<div class="mb-1">
										<label for="todoTitleAdd" class="form-label">Task Name</label>
										<input type="text" id="todoTitleAdd" name="sub_task_name"
											class="new-todo-item-title form-control" placeholder="Enter your task name" />
									</div>
									<div class="mb-1 position-relative">
										<label for="task-list" class="form-label d-block">Task List</label>
										<select class="select2 form-select" id="task-list" name="task_id">
											@foreach ($tasks as $task)
												<option value=`${task.id}` selected>
													Uncategorized
												</option>
											@endforeach
										</select>
									</div>
									<div class="mb-1 position-relative">
										<label for="task-assigned" class="form-label d-block">Assignee</label>
										<select class="select2 form-select" id="task-assigned" name="sub_task_assignee">
											<option data-img="{{ asset('images/portrait/small/avatar-s-3.jpg') }}"
												value="Phill Buffer" selected>
												Phill Buffer
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-1.jpg') }}"
												value="Chandler Bing">
												Chandler Bing
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-4.jpg') }}"
												value="Ross Geller">
												Ross Geller
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-6.jpg') }}"
												value="Monica Geller">
												Monica Geller
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-2.jpg') }}"
												value="Joey Tribbiani">
												Joey Tribbiani
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-11.jpg') }}"
												value="Rachel Green">
												Rachel Green
											</option>
										</select>
									</div>
									<div class="mb-1 position-relative">
										<label for="task-reviewer" class="form-label d-block">Reviewer</label>
										<select class="select2 form-select" id="task-reviewer" name="sub_task_reviewer">
											<option data-img="{{ asset('images/portrait/small/avatar-s-3.jpg') }}"
												value="Phill Buffer" selected>
												Phill Buffer
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-1.jpg') }}"
												value="Chandler Bing">
												Chandler Bing
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-4.jpg') }}"
												value="Ross Geller">
												Ross Geller
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-6.jpg') }}"
												value="Monica Geller">
												Monica Geller
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-2.jpg') }}"
												value="Joey Tribbiani">
												Joey Tribbiani
											</option>
											<option data-img="{{ asset('images/portrait/small/avatar-s-11.jpg') }}"
												value="Rachel Green">
												Rachel Green
											</option>
										</select>
									</div>
									<div class="mb-1">
										<label for="task-due-date" class="form-label">Due Date</label>
										<input type="text" class="form-control task-due-date" id="sub_task_due_date"
											name="task-due-date" />
									</div>
									<div class="mb-1">
										<label class="form-label">Description</label>
										<div id="task-desc" class="border-bottom-0" name="sub_task_description"
											data-placeholder="Write Your Description">
										</div>
										<div class="d-flex justify-content-end desc-toolbar border-top-0">
											<span class="ql-formats me-0">
												<button class="ql-bold"></button>
												<button class="ql-italic"></button>
												<button class="ql-underline"></button>
												<button class="ql-align"></button>
												<button class="ql-link"></button>
											</span>
										</div>
									</div>
								</div>
								<div class="my-1">
									<button type="submit" class="btn btn-primary add-todo-item me-1">Add</button>
									<button type="button" class="btn btn-outline-secondary add-todo-item"
										data-bs-dismiss="modal">
										Cancel
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Right Sidebar ends -->
		</section>
	</div>
</div>
@endsection


@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/dragula.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

@endsection

@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-todo.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-calendar.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-chat.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-chat-list.css')) }}">
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

<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/app-todo.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-chat.js')) }}"></script>

@endsection
