<!-- Project Header -->
<div class="content-header row mb-0">
	<h1 class="content-header-left col-md-9 col-12 mb-0">
		<span class="menu-title text-truncate">Project: {{ $project->name }}</span>
	</h1>
	<div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
		<div class="mb-0 breadcrumb-right">
			<div class="d-inline">
				<a type="button" class="text-primary btn-icon btn btn-round"  href="{{ route('project.report', ['slug' => $project->slug]) }}">
					<span class="fw-bold">Report</span>
					<i data-feather="pie-chart" class="font-medium-3 me-50"></i>
				</a>
			</div>
			<div class="d-inline">
				<a type="button" class="text-primary btn-icon btn btn-round"  href="{{ route('project.settings', ['slug' => $project->slug]) }}">
					<span class="fw-bold">Settings</span>
					<i data-feather="settings" class="font-medium-3 me-50"></i>
				</a>
			</div>
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
		</div>
	</div>
</div>
<!--/ Project Header -->
<hr />