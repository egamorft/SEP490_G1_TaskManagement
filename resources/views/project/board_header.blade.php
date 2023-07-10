<!-- Project Header -->
<div class="content-header row mb-0">
    <h4 class="mt-1 content-header-left col-md-10 col-12 mb-0">
        <span class="menu-title text-truncate">Board: {{ 'Board Name' }}</span>
    </h4>
    <div class="content-header-right text-md-end col-md-2 col-12 d-md-block d-none">
        <div class="mb-0 breadcrumb-right">
            <div class="d-inline">
                <a class="btn-icon btn btn-outline-primary" type="button"  href=""
					data-bs-toggle="modal" data-bs-target="#editBoardModal{{ 0 }}" data-id="{{ 0 }}">
                    <i data-feather="edit"></i>
                </a>
            </div>
			<div class="d-inline">
				<a class="btn-icon btn btn-outline-primary" type="button" href=""
					data-bs-toggle="modal" data-bs-target="#removeBoardModal{{ 0 }}" data-id="{{ 0 }}">
                    <i data-feather="trash-2"></i>
                </a>
            </div>
			<div class="d-inline">
				<a class="btn-icon btn btn-outline-primary" type="button" href="{{ route('view.project.board', ['slug' => $project->slug]) }}">
					<i data-feather="x-square"></i>
				</a>
            </div>
        </div>
    </div>
</div>
<!--/ Project Header -->
<hr />
@include('content._partials._modals.modal-edit-board')
@include('content._partials._modals.modal-remove-board')
