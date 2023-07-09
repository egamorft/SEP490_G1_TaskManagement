<!-- Project Header -->
<div class="content-header row mb-0">
	<h1 class="content-header-left col-md-8 col-12 mb-0">
		<span class="menu-title text-truncate">Project: {{ $project->name }}</span>
	</h1>
	<div class="content-header-right text-md-end col-md-4 col-12 d-md-block d-none">
		<div class="mb-0 breadcrumb-right">
			<div class="d-inline">
				<a type="button" class="{{ $page == 'board' ? 'border-bottom-primary' : '' }} text-primary btn-icon btn btn-round"  href="{{ route('view.project.board', ['slug' => $project->slug]) }}">
					<span class="fw-bold">Board</span>
					<i data-feather="list" class="font-medium-3 me-50"></i>
				</a>
			</div>
			<div class="d-inline">
				<a type="button" class="{{ $page == 'report' ? 'border-bottom-primary' : '' }} text-primary btn-icon btn btn-round"  href="{{ route('view.project.report', ['slug' => $project->slug]) }}">
					<span class="fw-bold">Report</span>
					<i data-feather="pie-chart" class="font-medium-3 me-50"></i>
				</a>
			</div>
			<div class="d-inline">
				<a type="button" class="{{ $page == 'settings' ? 'border-bottom-primary' : '' }} text-primary btn-icon btn btn-round"  href="{{ route('project.settings', ['slug' => $project->slug]) }}">
					<span class="fw-bold">Settings</span>
					<i data-feather="settings" class="font-medium-3 me-50"></i>
				</a>
			</div>
			@can('check-permission', 'evaluate-project')
			<div class="d-inline">
				<button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
					data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i data-feather="grid"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalRejectProject">
						<i data-feather='x-circle'></i>
						Reject
					</a>
					<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalApproveProject">
						<i data-feather='check-circle'></i>
						Mark as done
					</a>
				</div>
			</div>
			@endcan
		</div>
	</div>
</div>
<!--/ Project Header -->
<hr />

<!-- Left Sidebar reject project starts -->
<div class="modal modal-slide-in sidebar-todo-modal fade" id="modalRejectProject">
	<div class="modal-dialog sidebar-lg" style="left: 0">
		<div class="modal-content p-0">
			<form id="formRejectProject" class="todo-modal">
				<div class="modal-header align-items-center mb-1">
					<h5 class="modal-title">Reject "{{ $project->name }}"</h5>
					<div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
						<span class="todo-item-favorite cursor-pointer me-75"><i data-feather="star"
								class="font-medium-2"></i></span>
						<i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
					</div>
				</div>
				<div class="modal-body flex-grow-1 pb-sm-0 pb-3">
					<div class="action-tags">
						<div class="alert alert-danger mb-2" role="alert">
							<h6 class="alert-heading">You are trying to reject this project?</h6>
							<div class="alert-body fw-normal">Your action will stop all of activities in project
							</div>
						</div>
						<div class="mb-1">
							<label class="form-label">Reason</label>
							<div id="reject-project" class="border-bottom-0"
								data-placeholder="Why you want reject this project?"></div>
							<div class="d-flex justify-content-end desc-toolbar-2 border-top-0">
								<span class="ql-formats me-0">
									<button class="ql-bold"></button>
									<button class="ql-italic"></button>
									<button class="ql-underline"></button>
								</span>
							</div>
						</div>
					</div>
					<div class="my-1">
						<button type="submit" class="btn btn-danger add-todo-item me-1">Reject</button>
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
<!-- Left Sidebar reject project ends -->

<!-- Right Sidebar approve project starts -->
<div class="modal modal-slide-in sidebar-todo-modal fade" id="modalApproveProject">
	<div class="modal-dialog sidebar-lg">
		<div class="modal-content p-0">
			<form id="formApproveProject" class="todo-modal">
				<div class="modal-header align-items-center mb-1">
					<h5 class="modal-title">Approve "{{ $project->name }}"</h5>
					<div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
						<span class="todo-item-favorite cursor-pointer me-75"><i data-feather="star"
								class="font-medium-2"></i></span>
						<i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
					</div>
				</div>
				<div class="modal-body flex-grow-1 pb-sm-0 pb-3">
					<div class="action-tags">
						<div class="alert alert-success mb-2" role="alert">
							<h6 class="alert-heading">You are trying to approve this project?</h6>
							<div class="alert-body fw-normal">Congratulation for your project succeed
							</div>
						</div>
						<div class="mb-1">
							<label class="form-label">Reason</label>
							<div id="approve-project" class="border-bottom-0"
								data-placeholder="Why you want reject this project?"></div>
							<div class="d-flex justify-content-end desc-toolbar-1 border-top-0">
								<span class="ql-formats me-0">
									<button class="ql-bold"></button>
									<button class="ql-italic"></button>
									<button class="ql-underline"></button>
								</span>
							</div>
						</div>
					</div>
					<div class="my-1">
						<button type="submit" class="btn btn-success add-todo-item me-1">Approve</button>
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
<!-- Right Sidebar approve project ends -->