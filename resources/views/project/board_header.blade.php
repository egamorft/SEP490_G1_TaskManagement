<!-- Project Header -->
<div class="content-header row mb-0">
    <h4 class="mt-1 content-header-left col-md-10 col-12 mb-0">
        <span class="menu-title text-truncate">Board: {{ $board->title }}</span>
    </h4>
    <div class="content-header-right text-md-end col-md-2 col-12 d-md-block d-none">
        <div class="mb-0 breadcrumb-right">
            @if ($current_role == 'pm' || $current_role == 'supervisor')
                <div class="d-inline">
                    <a class="btn-icon btn btn-outline-primary" type="button" href="" data-bs-toggle="modal"
                        data-bs-target="#editBoard{{ $board->id }}" title="Edit this board">
                        <i data-feather="edit"></i>
                    </a>
                </div>
                <div class="d-inline">
                    <a class="btn-icon btn btn-outline-primary" type="button" href="" data-bs-toggle="modal"
                        data-bs-target="#removeBoard{{ $board->id }}" title="Delete this board">
                        <i data-feather="trash-2"></i>
                    </a>
                </div>
            @endif
            <div class="d-inline">
                <a class="btn-icon btn btn-outline-primary" type="button"
                    href="{{ route('view.project.board', ['slug' => $project->slug]) }}" title="Back to board">
                    <i data-feather="skip-back"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!--/ Project Header -->
<hr />
@include('content._partials._modals.modal-edit-board')
@include('content._partials._modals.modal-remove-board')
