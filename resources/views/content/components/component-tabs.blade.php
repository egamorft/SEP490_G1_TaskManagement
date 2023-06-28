@extends('layouts/contentLayoutMaster')

@section('title', 'Project-' . $project->name)

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
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
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="taskList-tab" data-bs-toggle="tab" href="#taskList"
                                    aria-controls="taskList" role="tab" aria-selected="false"><i
                                        data-feather='list'></i>
                                    Task List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="gantt-tab" data-bs-toggle="tab" href="#gantt" aria-controls="gantt"
                                    role="tab" aria-selected="false"><i data-feather='activity'></i>
                                    Gantt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="calendar-tab" data-bs-toggle="tab" href="#calendar"
                                    aria-controls="calendar" role="tab" aria-selected="false"><i
                                        data-feather='calendar'></i>
                                    Calendar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="report-tab" data-bs-toggle="tab" href="#report"
                                    aria-controls="report" role="tab" aria-selected="false"><i
                                        data-feather='alert-octagon'></i>
                                    Report</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="settings-tab" data-bs-toggle="tab" href="#settings"
                                    aria-controls="settings" role="tab" aria-selected="true"><i
                                        data-feather='settings'></i>
                                    Settings</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="taskList" aria-labelledby="taskList-tab" role="tabpanel">
                                <p>
                                    Task List
                                </p>
                            </div>
                            <div class="tab-pane" id="gantt" aria-labelledby="gantt-tab" role="tabpanel">
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
                            <div class="tab-pane active" id="settings" aria-labelledby="settings-tab" role="tabpanel">
                                <!-- Settings Tab Wizard -->
                                <section class="modern-vertical-wizard">
                                    <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example">
                                        <div class="bs-stepper-header">
                                            <div class="step" data-target="#project-information" role="tab"
                                                id="project-information-trigger">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-box">
                                                        <i data-feather='info' class="font-medium-5"></i>
                                                    </span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Project information</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="step" data-target="#project-members" role="tab"
                                                id="project-members-trigger">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-box">
                                                        <i data-feather='users' class="font-medium-5"></i>
                                                    </span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Project Members</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="step" data-target="#permission-role" role="tab"
                                                id="permission-role-trigger">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-box">
                                                        <i data-feather='shield' class="font-medium-5"></i>
                                                    </span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Permission By Role</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                            <div id="project-information" class="content" role="tabpanel"
                                                aria-labelledby="project-information-trigger">
                                                <form action="{{ route('project.update', $project->id) }}" method="post">
                                                    @csrf
                                                    <div class="col-12 col-md-12 mb-2">
                                                        <label class="form-label" for="settingProjectName">Project
                                                            Name</label>
                                                        <input type="text" id="settingProjectName"
                                                            name="settingProjectName"
                                                            class="form-control @error('settingProjectName') is-invalid @enderror"
                                                            placeholder="Project Name"
                                                            value="{{ old('settingProjectName', $project->name) }}"
                                                            data-msg="Please enter your project name" />
                                                        @error('settingProjectName')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-md-12 mb-2">
                                                        <label class="form-label" for="fp-range-1">Pick your project
                                                            duration</label>
                                                        <input name="settingDuration" type="text" id="fp-range-1"
                                                            class="form-control flatpickr-range @error('settingDuration') is-invalid @enderror"
                                                            placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                                            value="{{ old('settingDuration', $project->start_date . ' to ' . $project->end_date) }}" />
                                                        @error('settingDuration')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <label class="form-label" for="settingDesc">Description</label>
                                                        <textarea id="settingDesc" name="settingDesc" class="form-control"
                                                            placeholder="To sell or distribute something as a business deal">{{ $project->description }}</textarea>
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-2">
                                                        <button type="submit" class="btn btn-outline-primary">
                                                            Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div id="project-members" class="content" role="tabpanel"
                                                aria-labelledby="project-members-trigger">
                                                <div class="content-header row">
                                                    <div class="col-6">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <h5 class="mb-0" style="font-size: 1rem;">Project Manager
                                                            </h5>
                                                            <a data-toggle="modal" data-target="#popupModal">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="currentColor"
                                                                    class="bi bi-pencil" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <img class="round me-1"
                                                                src="{{ Auth::user() ? asset('images/avatars/1.png') : '' }}"
                                                                alt="avatar" height="40" width="40">
                                                            <div>
                                                                <h5 class="mb-0" style="font-size: 1rem;">Personal Info
                                                                </h5>
                                                                <small style="font-size: 0.7rem;">@email</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <h6 class="mb-0">Project Supervisor
                                                            </h6>
                                                            <a data-toggle="modal" data-target="#popupModal">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="currentColor"
                                                                    class="bi bi-pencil" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <img class="round me-1"
                                                                src="{{ Auth::user() ? asset('images/avatars/1.png') : '' }}"
                                                                alt="avatar" height="40" width="40">
                                                            <div>
                                                                <h6 class="mb-0">Personal Info
                                                                </h6>
                                                                <small style="font-size: 0.7rem;">@email</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="my-2">
                                                <div class="row">
                                                    <div class="mb-3 col-md-12">
                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="mb-0">Project Members</h6>
                                                            <a data-toggle="modal" data-target="#popupModal">
                                                                <div class="d-flex align-items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                        height="18" fill="currentColor"
                                                                        class="bi bi-person-plus-fill me-1"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                                        <path fill-rule="evenodd"
                                                                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                                                    </svg>
                                                                    <h6 class="mb-0">Add new member</h6>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    <div class="mb-1 col-md-4">
                                                        <div class="d-flex align-items-center">
                                                            <img class="round me-1"
                                                                src="{{ Auth::user() ? asset('images/avatars/1.png') : '' }}"
                                                                alt="avatar" height="40" width="40">
                                                            <div>
                                                                <h6 class="mb-0">Personal Info
                                                                </h6>
                                                                <small style="font-size: 0.7rem;">@email</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1 col-md-3">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="mb-0">Role</h5>
                                                            <a data-toggle="modal" data-target="#popupModal">

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-pencil-fill ms-2" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1 col-md-5">
                                                        <div class="d-flex justify-content-end">
                                                            <div class="d-flex align-items-center me-5">
                                                                <a class="d-flex align-items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" fill="currentColor"
                                                                        class="bi bi-c-circle me-1" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512Z" />
                                                                    </svg>
                                                                    <h5 class="mb-0">Set as new manager</h5>
                                                                </a>
                                                            </div>
                                                            <div class="d-flex align-items-center">

                                                                <a class="d-flex align-items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" fill="currentColor"
                                                                        class="bi bi-person-x-fill me-1"
                                                                        viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd"
                                                                            d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                                                                    </svg>
                                                                    <h5 class="mb-0">Remove</h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="permission-role" class="content" role="tabpanel"
                                                aria-labelledby="permission-role-trigger">
                                                <div class="content-header">
                                                    <h5 class="mb-0">Address</h5>
                                                    <small>Enter Your Address.</small>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label"
                                                            for="vertical-modern-address">Address</label>
                                                        <input type="text" id="vertical-modern-address"
                                                            class="form-control"
                                                            placeholder="98  Borough bridge Road, Birmingham" />
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label"
                                                            for="vertical-modern-landmark">Landmark</label>
                                                        <input type="text" id="vertical-modern-landmark"
                                                            class="form-control" placeholder="Borough bridge" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="pincode4">Pincode</label>
                                                        <input type="text" id="pincode4" class="form-control"
                                                            placeholder="658921" />
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="city4">City</label>
                                                        <input type="text" id="city4" class="form-control"
                                                            placeholder="Birmingham" />
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-primary btn-prev">
                                                        <i data-feather="arrow-left"
                                                            class="align-middle me-sm-25 me-0"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <button class="btn btn-primary btn-next">
                                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                        <i data-feather="arrow-right"
                                                            class="align-middle ms-sm-25 ms-0"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- /Settings Tab Wizard -->
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
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('js/scripts/components/components-navs.js') }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
@endsection
