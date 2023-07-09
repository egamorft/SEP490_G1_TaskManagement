@extends('layouts/contentLayoutMaster')

@section('title', 'Roles')

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

    <!-- Project Header -->
    <div class="content-header row mb-0">
        <h1 class="content-header-left col-md-9 col-12 mb-0">
            <span class="menu-title text-truncate">Project: {{ $project->name }}</span>
        </h1>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-0 breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('project.settings', ['slug' => $project->slug]) }}">
                            <i data-feather='settings'></i>
                            Settings
                        </a>
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

    <h4>Project Information</h4>
    <p class="mb-2">
        {{ $project->description ? $project->description : 'No Description' }}
    </p>

    <!-- Info Card -->
    <div class="card card-user-timeline">
        <div class="card-body">
            <div class="row">
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
                    <div class="more-info">
                        <p class="mb-50">Duration: 90%</p>
                        <div class="progress progress-bar-success" style="height: 6px">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90"
                                aria-valuemax="100" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />

            <div class="row">
                <div class="col mt-0">
                    <div class="avatar float-start bg-white rounded me-1">
                        <div class="avatar float-start bg-white rounded me-1" style="margin-top: 12px;">
                            <img src="{{ asset('images/avatars/' . $pmAccount->avatar) }}" alt="Avatar" width="33"
                                height="33" />
                        </div>
                    </div>
                    <div class="more-info">
                        <small>Project Manager</small>
                        <h6 class="mb-0">{{ $pmAccount->fullname }}</h6>
                    </div>
                </div>
                <div class="col mt-0">
                    <div class="avatar float-start bg-white rounded me-1">
                        <div class="avatar float-start bg-white rounded me-1" style="margin-top: 12px;">
                            <img src="{{ asset('images/avatars/' . $supervisorAccount->avatar) }}" alt="Avatar"
                                width="33" height="33" />
                        </div>
                    </div>
                    <div class="more-info">
                        <small>Project Supervisor</small>
                        <h6 class="mb-0">{{ $supervisorAccount->fullname }}</h6>
                    </div>
                </div>
                <div class="col mt-0">
                    <div class="more-info">
                        <small>Other Members</small>
                    </div>
                    <div class="avatar-group">
                        @php
                            $limitCount = 0;
                            $moreMember = 0;
                        @endphp
                        @foreach ($memberAccount as $acc)
                            @php
                                $limitCount++;
                                if ($limitCount > 2) {
                                    $moreMember++;
                                    continue;
                                }
                            @endphp
                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
                                title="{{ $acc->fullname }}" class="avatar pull-up">
                                <img src="{{ asset('images/avatars/' . $acc->avatar) }}" alt="Avatar" width="33"
                                    height="33" />
                            </div>
                        @endforeach
                        <h6 class="align-self-center cursor-pointer ms-50 mb-0">+{{ $moreMember }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Info Card -->

    <hr />

    <h4>Board List</h4>
    <p class="mb-2">
        Tập hợp các Task, ví dụ như mỗi board là 1 iteration... <br />
    </p>

    <!-- Board cards -->
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end justify-content-center h-100">
                            <img src="{{ asset('images/illustration/faq-illustrations.svg') }}" class="img-fluid mt-2"
                                alt="Image" width="72" />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                class="stretched-link text-nowrap add-new-role">
                                <span class="btn btn-primary mb-1">Add New Board</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ----------- --}}
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <a class="card-body" href="{{ route('project.settings', ['slug' => $project->slug]) }}">
                    <div class="d-flex justify-content-between">
                        <span>Total {{ 4 }} tasks</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                        <div class="role-heading">
                            <h4 class="fw-bolder">{{ 'Iteration 1' }}</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <a class="card-body" href="{{ route('project.settings', ['slug' => $project->slug]) }}">
                    <div class="d-flex justify-content-between">
                        <span>Total {{ 4 }} tasks</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                        <div class="role-heading">
                            <h4 class="fw-bolder">{{ 'Iteration 1' }}</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <a class="card-body" href="{{ route('project.settings', ['slug' => $project->slug]) }}">
                    <div class="d-flex justify-content-between">
                        <span>Total {{ 4 }} tasks</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                        <div class="role-heading">
                            <h4 class="fw-bolder">{{ 'Iteration 1' }}</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <a class="card-body" href="{{ route('project.settings', ['slug' => $project->slug]) }}">
                    <div class="d-flex justify-content-between">
                        <span>Total {{ 4 }} tasks</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                        <div class="role-heading">
                            <h4 class="fw-bolder">{{ 'Iteration 1' }}</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--/ Board cards -->

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
@endsection
