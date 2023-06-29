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
						<!-- BEGIN: Header-->
						@include('projects.header')

						<div class="tab-content">
                            <div class="tab-pane active" id="taskList" aria-labelledby="taskList-tab" role="tabpanel">
								@include('tasks.list')
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
                            <div class="tab-pane " id="settings" aria-labelledby="settings-tab" role="tabpanel">
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
                                            <div class="step" data-target="#email-notifications" role="tab"
                                                id="email-notifications-trigger">
                                                <button type="button" class="step-trigger">
                                                    <span class="bs-stepper-box">
                                                        <i data-feather='mail' class="font-medium-5"></i>
                                                    </span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Email notifications</span>
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
                                                            name="settingProjectName" class="form-control @error('settingProjectName') is-invalid @enderror"
                                                            placeholder="Project Name" value="{{ old('settingProjectName', $project->name) }}"
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
                                                            value="{{ old('settingDuration', $project->start_date .' to '. $project->end_date) }}" />
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
                                                <div class="content-header">
                                                    <h5 class="mb-0">Personal Info</h5>
                                                    <small>Enter Your Personal Info.</small>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="vertical-modern-first-name">First
                                                            Name</label>
                                                        <input type="text" id="vertical-modern-first-name"
                                                            class="form-control" placeholder="John" />
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="vertical-modern-last-name">Last
                                                            Name</label>
                                                        <input type="text" id="vertical-modern-last-name"
                                                            class="form-control" placeholder="Doe" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label"
                                                            for="vertical-modern-country">Country</label>
                                                        <select class="select2 w-100" id="vertical-modern-country">
                                                            <option label=" "></option>
                                                            <option>UK</option>
                                                            <option>USA</option>
                                                            <option>Spain</option>
                                                            <option>France</option>
                                                            <option>Italy</option>
                                                            <option>Australia</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label"
                                                            for="vertical-modern-language">Language</label>
                                                        <select class="select2 w-100" id="vertical-modern-language"
                                                            multiple>
                                                            <option>English</option>
                                                            <option>French</option>
                                                            <option>Spanish</option>
                                                        </select>
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
                                            <div id="email-notifications" class="content" role="tabpanel"
                                                aria-labelledby="email-notifications-trigger">
                                                <div class="content-header">
                                                    <h5 class="mb-0">Social Links</h5>
                                                    <small>Enter Your Social Links.</small>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label"
                                                            for="vertical-modern-twitter">Twitter</label>
                                                        <input type="text" id="vertical-modern-twitter"
                                                            class="form-control" placeholder="https://twitter.com/abc" />
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label"
                                                            for="vertical-modern-facebook">Facebook</label>
                                                        <input type="text" id="vertical-modern-facebook"
                                                            class="form-control" placeholder="https://facebook.com/abc" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label"
                                                            for="vertical-modern-google">Google+</label>
                                                        <input type="text" id="vertical-modern-google"
                                                            class="form-control"
                                                            placeholder="https://plus.google.com/abc" />
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label"
                                                            for="vertical-modern-linkedin">Linkedin</label>
                                                        <input type="text" id="vertical-modern-linkedin"
                                                            class="form-control" placeholder="https://linkedin.com/abc" />
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-primary btn-prev">
                                                        <i data-feather="arrow-left"
                                                            class="align-middle me-sm-25 me-0"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <button class="btn btn-success btn-submit">Submit</button>
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
