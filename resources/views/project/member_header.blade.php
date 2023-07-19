<!-- Member Header -->
<div class="content-header row mb-0">
    <h4 class="mt-0 content-header-left col-md-10 col-12 mb-0">
        <span class="menu-title text-truncate">User: {{ 'User Name' }}</span>
		<br/>
		<span style="font-size: 14px;" class="menu-title text-truncate">Project Manager</span>
    </h4>
    <div class="content-header-right text-md-end col-md-2 col-12 d-md-block d-none">
        <div class="mb-0 breadcrumb-right">
			<div class="d-inline">
				<a class="btn-icon btn btn-outline-primary" type="button" href="{{ route('view.project.report', ['slug' => $project->slug]) }}">
					<i data-feather="x-square"></i>
				</a>
            </div>
        </div>
    </div>
</div>
<!--/ Member Header -->
<hr />
