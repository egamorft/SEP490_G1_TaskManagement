@extends('layouts/contentLayoutMaster')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/dragula.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-todo.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('content')
    @include('project.header')

    <h4>Project Information</h4>
    <p class="mb-2">
        {{ $project->description ? $project->description : '#No Description' }}
    </p>

    <!-- Info Card -->
    <div class="card card-user-timeline {{ $disabledProject ? 'opacity-50 pointer-events-none' : '' }}">
        <div class="card-body">
            <div class="row">
                @switch($project->project_status)
                    @case(-1)
                        <div class="col mt-0">
                            <div class="avatar float-start bg-light-danger rounded me-1">
                                <div class="avatar-content">
                                    <i data-feather="alert-triangle" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="more-info">
                                <h6 class="mb-0 text-danger">Fail</h6>
                                <small>You have fail this project according to supervisor proposed</small>
                            </div>
                        </div>
                    @break

                    @case(0)
                        <div class="col mt-0">
                            <div class="avatar float-start bg-light-warning rounded me-1">
                                <div class="avatar-content">
                                    <i data-feather="pause-circle" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="more-info">
                                <h6 class="mb-0 text-warning">Todo</h6>
                                <small>The project is not have supervisor</small>
                            </div>
                        </div>
                    @break

                    @case(1)
                        <div class="col mt-0">
                            <div class="avatar float-start bg-light-primary rounded me-1">
                                <div class="avatar-content">
                                    <i data-feather="fast-forward" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="more-info">
                                <h6 class="mb-0 text-primary">Doing</h6>
                                <small>The project is in progress</small>
                            </div>
                        </div>
                    @break

                    @case(2)
                        <div class="col mt-0">
                            <div class="avatar float-start bg-light-success rounded me-1">
                                <div class="avatar-content">
                                    <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="more-info">
                                <h6 class="mb-0 text-success">Done</h6>
                                <small>Congratulations!! You have done this project</small>
                            </div>
                        </div>
                    @break

                    @default
                        <div class="col mt-0">
                            <div class="avatar float-start bg-light-warning rounded me-1">
                                <div class="avatar-content">
                                    <i data-feather="help-circle" class="avatar-icon font-medium-3"></i>
                                </div>
                            </div>
                            <div class="more-info">
                                <h6 class="mb-0 text-warning">Done</h6>
                                <small>Something went wrong here</small>
                            </div>
                        </div>
                @endswitch
                <div class="mt-0 col">
                    <div class="avatar float-start bg-light-primary rounded me-1">
                        <div class="avatar-content">
                            <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
                        </div>
                    </div>
                    <div class="more-info">
                        <small>From {{ date('D, M d, Y', strtotime($project->start_date)) }}</small>
                        <h6 class="mb-0">To {{ date('D, M d, Y', strtotime($project->end_date)) }}</h6>
                    </div>
                </div>

                <div class="mt-0 col">
                    <div class="avatar float-start bg-light-primary rounded me-1">
                        <div class="avatar-content">
                            <i data-feather="activity" class="avatar-icon font-medium-3"></i>
                        </div>
                    </div>
                    @php
                        $colorProgressState = '';
                        
                        if (0 <= $percent_completed && $percent_completed <= 40) {
                            $colorProgressState = '#45ba30';
                        } elseif (40 < $percent_completed && $percent_completed <= 60) {
                            $colorProgressState = '#c4bc21';
                        } elseif (60 < $percent_completed && $percent_completed <= 80) {
                            $colorProgressState = '#db8223';
                        } elseif (80 < $percent_completed && $percent_completed <= 100) {
                            $colorProgressState = '#e63217';
                        } else {
                            $colorProgressState = '';
                        }
                    @endphp
                    <div class="more-info">
                        <p class="mb-50">Duration: {{ $percent_completed }}% ({{ $days_left }} days remaining) </p>
                        <div class="progress progress-bar-secondary" style="height: 6px">
                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                aria-valuenow="{{ $percent_completed }}" aria-valuemin="{{ $percent_completed }}"
                                aria-valuemax="100"
                                style="width: {{ $percent_completed }}%; ; background-color: {{ $colorProgressState }}!important">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />

            <div class="row">
                <div class="col mt-0">
                    <div class="avatar float-start bg-white rounded">
                        <div class="avatar float-start bg-white rounded me-1" style="margin-top: 12px;">
                            <img src="{{ asset('images/avatars/' . $pmAccount->avatar) }}" alt="Avatar" width="33"
                                height="33" />
                        </div>
                    </div>
                    <div class="more-info" style="margin-top: 10px;">
                        <small>Project Manager</small>
                        <h6 class="mb-0">{{ $pmAccount->fullname ?? "" }}</h6>
                    </div>
                </div>
                <div class="col mt-0">
                    <div class="avatar float-start bg-white rounded">
                        <div class="avatar float-start bg-white rounded me-1" style="margin-top: 12px;">
                            <img src="{{ isset($supervisorAccount->avatar) ? asset('images/avatars/' . $supervisorAccount->avatar) : asset('images/avatars/default.png') }}"
                                alt="Avatar" width="33" height="33" />
                        </div>
                    </div>
                    <div class="more-info" style="margin-top: 10px;">
                        <small>Project Supervisor</small>
                        <h6 class="mb-0">
                            {{ $supervisorAccount->fullname ?? 'Waiting for supervisor...' }}
                        </h6>
                    </div>
                </div>
                <div class="col mt-0">
                    <div class="more-info">
                        <small>Other Members</small>
                    </div>
                    <div class="avatar-group">
                        @forelse ($memberAccount as $acc)
                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
                                title="{{ $acc->fullname }}" class="avatar pull-up">
                                <img src="{{ asset('images/avatars/' . $acc->avatar) }}" alt="Avatar" width="33"
                                    height="33" />
                            </div>
                        @empty
                            <div class="d-flex align-items-center me-2">
                                <strong>Waiting for the very first member to accept
                                    invitation...</strong>
                                <div class="spinner-border ms-2" role="status" aria-hidden="true"></div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Info Card -->
    <hr />

    <h4>Board List</h4>
    <p class="mb-2">
        Set of Tasks, E.g: each board is 1 iteration... <br />
    </p>

    <!-- Board cards -->
    <div class="row {{ $disabledProject ? 'opacity-50 pointer-events-none' : '' }}">
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end justify-content-center h-100">
                            <img src="{{ asset('images/illustration/faq-illustrations.svg') }}" class="img-fluid mt-2"
                                alt="Image" width="87" />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a href="javascript:void(0)" data-bs-target="#addBoardModal" data-bs-toggle="modal"
                                class="stretched-link text-nowrap add-new-role">
                                <span class="btn btn-primary mb-1">Add New Board</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($boards as $board)
            <!-- Board Item -->
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total {{ $board->tasks()->count() }} tasks</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <a class="role-heading"
                                href="{{ route('view.board.kanban', ['slug' => $project->slug, 'board_id' => $board->id]) }}">
                                <h4 class="fw-bolder">{{ $board->title }}</h4>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="javascript:;" class="board-edit-modal" data-bs-toggle="modal"
                                data-bs-target="#editBoardModal{{ $board->id }}">
                                <small>Edit Board</small>
                            </a>
                            <a href="javascript:;" class="board-edit-modal" data-bs-toggle="modal"
                                data-bs-target="#removeBoardModal{{ $board->id }}" class="text-body delete-board"><i
                                    data-feather="trash-2" class="font-medium-5"></i></a>
                        </div>
                        @include('content._partials._modals.modal-edit-board')
                        @include('content._partials._modals.modal-remove-board')
                    </div>
                </div>
            </div>
            <!--/ Board Item -->
        @endforeach

    </div>
    <!--/ Board cards -->

    @include('content._partials._modals.modal-add-new-board')
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/dragula.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-clipboard.js')) }}"></script>
    <script src="{{ asset('js/scripts/components/components-navs.js') }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-todo.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/project/board.js')) }}"></script>
@endsection
