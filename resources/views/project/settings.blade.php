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
    <!-- Basic tabs start -->
    <section id="basic-tabs-components">
        <div class="row match-height" id="section-block">
            <!-- Tabs with Icon starts -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings" aria-labelledby="settings-tab" role="tabpanel">
                                <!-- Settings Tab Wizard -->
                                <section class="modern-vertical-wizard">
                                    <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example">
                                        <div class="bs-stepper-header">
                                            @can('check-permission', 'change-project-information')
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
                                            @endcan
                                            @can('check-permission', 'view-member-list')
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
                                            @endcan
                                            @can('check-permission', 'set-up-project-privilege')
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
                                            @endcan
                                        </div>
                                        <div class="bs-stepper-content">
                                            <div id="project-information" class="content" role="tabpanel"
                                                aria-labelledby="project-information-trigger">
                                                <form
                                                    action="{{ route('project.update', ['slug' => $project->slug, 'id' => $project->id]) }}"
                                                    method="post">
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
                                                        <label class="form-label"
                                                            for="settingsProjectEditor">Description</label>
                                                        <div id="settingsProjectEditor">{!! $project->description !!}</div>
                                                        <input type="hidden" name="settingDesc" id="editorSettings"
                                                            value="{!! $project->description !!}">
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
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <img class="round me-1"
                                                                src="{{ Auth::user() ? asset('images/avatars/' . $pmAccount->avatar) : '' }}"
                                                                alt="avatar" height="40" width="40">
                                                            <div>
                                                                <h5 class="mb-0" style="font-size: 1rem;">
                                                                    {{ $pmAccount->name }}
                                                                </h5>
                                                                <small
                                                                    style="font-size: 0.7rem;">{{ $pmAccount->email }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <h6 class="mb-0">Project Supervisor
                                                            </h6>
                                                        </div>
                                                        @if (isset($supervisorAccount))
                                                            <div class="d-flex align-items-center">
                                                                <img class="round me-1"
                                                                    src="{{ Auth::user() ? asset('images/avatars/' . $supervisorAccount->avatar) : '' }}"
                                                                    alt="avatar" height="40" width="40">
                                                                <div>
                                                                    <h6 class="mb-0">{{ $supervisorAccount->name }}
                                                                    </h6>
                                                                    <small
                                                                        style="font-size: 0.7rem;">{{ $supervisorAccount->email }}</small>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @can('check-permission', 'control-teamsize')
                                                            @if (isset($pendingSupervisorAccount))
                                                                <div
                                                                    class="d-flex justify-content-between bg-light opacity-50">
                                                                    <div class="d-flex align-items-center">
                                                                        <img class="round me-1"
                                                                            src="{{ Auth::user() ? asset('images/avatars/' . $pendingSupervisorAccount->avatar) : '' }}"
                                                                            alt="avatar" height="40" width="40">
                                                                        <div>
                                                                            <h6 class="mb-0">
                                                                                {{ $pendingSupervisorAccount->name }}
                                                                            </h6>
                                                                            <small
                                                                                style="font-size: 0.7rem;">{{ $pendingSupervisorAccount->email }}</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex align-items-center me-2">
                                                                        <strong>Pending invite...</strong>
                                                                        <div class="spinner-border ms-2" role="status"
                                                                            aria-hidden="true"></div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @else
                                                            @if (isset($pendingSupervisorAccount))
                                                                <div
                                                                    class="d-flex justify-content-between bg-light opacity-50">
                                                                    <div class="d-flex align-items-center me-2">
                                                                        <strong>Waiting for supervisor to accept
                                                                            invitation...</strong>
                                                                        <div class="spinner-border ms-2" role="status"
                                                                            aria-hidden="true"></div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endcan
                                                    </div>
                                                </div>
                                                <hr class="my-2">
                                                <div class="row">
                                                    <div class="mb-3 col-md-12">
                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="mb-0">Project Members</h6>
                                                            @can('check-permission', 'control-teamsize')
                                                                @if ($checkLimitation < 6)
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#inviteToProject">
                                                                        <div class="d-flex align-items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="18" height="18"
                                                                                fill="currentColor"
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
                                                                @else
                                                                    <div class="alert alert-warning">
                                                                        <div class="d-flex align-items-center alert-body">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="18" height="18"
                                                                                fill="currentColor"
                                                                                class="bi bi-person-slash me-1"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465l3.465-3.465Zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465Zm-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                                                                            </svg>
                                                                            <h6 class="mb-0">Your team have reached limit of
                                                                                <strong>4</strong> invitaion & member
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endcan
                                                        </div>
                                                    </div>
                                                    @forelse ($memberAccount as $mem)
                                                        <div class="mb-1 col-md-4">
                                                            <div class="d-flex align-items-center">
                                                                <img class="round me-1"
                                                                    src="{{ Auth::user() ? asset('images/avatars/' . $mem->avatar) : '' }}"
                                                                    alt="avatar" height="40" width="40">
                                                                <div>
                                                                    <h6 class="mb-0">{{ $mem->name }}
                                                                    </h6>
                                                                    <small
                                                                        style="font-size: 0.7rem;">{{ $mem->email }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-1 col-md-3">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0">Member</h5>
                                                            </div>
                                                        </div>
                                                        <div class="mb-1 col-md-5">
                                                            <div class="d-flex justify-content-end">
                                                                @if ($current_role == 'pm')
                                                                    <div class="d-flex align-items-center me-5">
                                                                        <a data-bs-toggle="modal"
                                                                            data-bs-target="#setNewPMModal{{ $mem->id }}"
                                                                            class="d-flex align-items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="20" height="20"
                                                                                fill="currentColor"
                                                                                class="bi bi-c-circle me-1"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512Z" />
                                                                            </svg>
                                                                            <h5 class="mb-0">Set as new manager</h5>
                                                                        </a>
                                                                    </div>
                                                                    <div class="d-flex align-items-center">
                                                                        <a data-bs-toggle="modal"
                                                                            data-bs-target="#removeMemberModal{{ $mem->id }}"
                                                                            class="d-flex align-items-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="20" height="20"
                                                                                fill="currentColor"
                                                                                class="bi bi-person-x-fill me-1"
                                                                                viewBox="0 0 16 16">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                                                                            </svg>
                                                                            <h5 class="mb-0">Remove</h5>
                                                                        </a>
                                                                    </div>
                                                                    @include('content._partials._modals.modal-change-pm')
                                                                    @include('content._partials._modals.modal-remove-member')
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @empty
                                                    @endforelse

                                                    @forelse ($pendingInvitedMemberAccount as $penAcc)
                                                        <div class="mb-1 col-md-4 bg-light opacity-50">
                                                            <div class="d-flex align-items-center">
                                                                <img class="round me-1"
                                                                    src="{{ Auth::user() ? asset('images/avatars/' . $penAcc->avatar) : '' }}"
                                                                    alt="avatar" height="40" width="40">
                                                                <div>
                                                                    <h6 class="mb-0">{{ $penAcc->name }}
                                                                    </h6>
                                                                    <small
                                                                        style="font-size: 0.7rem;">{{ $penAcc->email }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-1 col-md-3 bg-light opacity-50">
                                                            <div class="d-flex align-items-center">
                                                                <strong>Pending invite...</strong>
                                                                <div class="spinner-border ms-2" role="status"
                                                                    aria-hidden="true"></div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-1 col-md-5 bg-light opacity-50">
                                                            <div class="d-flex justify-content-end">
                                                                <div class="d-flex align-items-center">
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#cancelInvitationModal{{ $penAcc->id }}"
                                                                        class="d-flex align-items-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            fill="currentColor"
                                                                            class="bi bi-backspace-reverse-fill me-1"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M0 3a2 2 0 0 1 2-2h7.08a2 2 0 0 1 1.519.698l4.843 5.651a1 1 0 0 1 0 1.302L10.6 14.3a2 2 0 0 1-1.52.7H2a2 2 0 0 1-2-2V3zm9.854 2.854a.5.5 0 0 0-.708-.708L7 7.293 4.854 5.146a.5.5 0 1 0-.708.708L6.293 8l-2.147 2.146a.5.5 0 0 0 .708.708L7 8.707l2.146 2.147a.5.5 0 0 0 .708-.708L7.707 8l2.147-2.146z" />
                                                                        </svg>
                                                                        <h5 class="mb-0">Cancel invitation</h5>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @include('content._partials._modals.modal-cancel-invitation')
                                                    @empty
                                                    @endforelse

                                                    @forelse ($removedMember as $rev)
                                                        <div
                                                            class="mb-1 col-md-4 bg-light opacity-50 text-decoration-line-through">
                                                            <div class="d-flex align-items-center">
                                                                <img class="round me-1"
                                                                    src="{{ Auth::user() ? asset('images/avatars/' . $rev->avatar) : '' }}"
                                                                    alt="avatar" height="40" width="40">
                                                                <div>
                                                                    <h6 class="mb-0">{{ $rev->name }}
                                                                    </h6>
                                                                    <small
                                                                        style="font-size: 0.7rem;">{{ $rev->email }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="mb-1 col-md-8 bg-light opacity-50 text-decoration-line-through">
                                                            <div class="d-flex align-items-center">
                                                                <strong>Member</strong>
                                                            </div>
                                                        </div>
                                                    @empty
                                                    @endforelse

                                                </div>
                                            </div>
                                            <div id="permission-role" class="content" role="tabpanel"
                                                aria-labelledby="permission-role-trigger">
                                                <div class="content-header">
                                                    <h4 class="mb-0">Sets of project privilege</h4>
                                                </div>
                                                <div class="col-12">
                                                    <!-- Permission table -->
                                                    <div class="table-responsive">
                                                        <table class="table table-flush-spacing">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-nowrap fw-bolder">
                                                                        Permission by roles
                                                                    </td>
                                                                    @php
                                                                        $role_count = $roles->count();
                                                                    @endphp
                                                                    @forelse ($roles as $r)
                                                                        <td class="align-middle text-center">
                                                                            @if ($r->name == 'pm')
                                                                                Project manager
                                                                                <span data-bs-toggle="tooltip"
                                                                                    data-bs-placement="top" title=""
                                                                                    data-bs-original-title="Have all role in a project">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="14" height="14"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-info">
                                                                                        <circle cx="12"
                                                                                            cy="12" r="10">
                                                                                        </circle>
                                                                                        <line x1="12"
                                                                                            y1="16" x2="12"
                                                                                            y2="12"></line>
                                                                                        <line x1="12"
                                                                                            y1="8" x2="12.01"
                                                                                            y2="8"></line>
                                                                                    </svg>
                                                                                </span>
                                                                            @else
                                                                                {{ $r->name }}
                                                                            @endif
                                                                        </td>
                                                                    @empty
                                                                    @endforelse
                                                                </tr>
                                                                @forelse ($permissions as $p)
                                                                    <tr>
                                                                        <td class="text-nowrap fw-bolder py-2">
                                                                            {{ $p->name }}
                                                                        </td>
                                                                        @forelse ($roles as $r)
                                                                            <td class="align-middle text-center">
                                                                                @php
                                                                                    $isChecked = $r->projectRolePermissions->contains(function ($permission) use ($p, $project) {
                                                                                        return $permission->permission_id == $p->id && $permission->project_id == $project->id;
                                                                                    });
                                                                                @endphp
                                                                                @if ($r->name == 'pm')
                                                                                    <div
                                                                                        class="form-check form-check-secondary align-middle text-center ms-5">
                                                                                        <input disabled
                                                                                            class="form-check-input"
                                                                                            type="checkbox"
                                                                                            id="{{ $r->id }}_{{ $p->id }}"
                                                                                            {{ $isChecked ? 'checked' : '' }}>
                                                                                    </div>
                                                                                @else
                                                                                    <div
                                                                                        class="form-check form-check-primary ms-2">
                                                                                        <input type="hidden"
                                                                                            name="csrf-token"
                                                                                            value="{{ csrf_token() }}">
                                                                                        <input type="hidden"
                                                                                            name="slug"
                                                                                            value="{{ $project->slug }}">
                                                                                        <input
                                                                                            class="form-check-input permission-role-editor"
                                                                                            type="checkbox"
                                                                                            id="{{ $r->id }}_{{ $p->id }}"
                                                                                            {{ $isChecked ? 'checked' : '' }}>
                                                                                    </div>
                                                                                @endif
                                                                            </td>
                                                                        @empty
                                                                        @endforelse
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="{{ $role_count }}">
                                                                            No permission found
                                                                        </td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- Permission table -->
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
            @if (Session::has('errorTask'))
                <!-- Change duration Modal -->
                <div class="modal fade" id="modalTask" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-add-new-board modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-3 pt-0">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">Change project duration! </h1>
                                    <p>Change project<b> {{ $project->title }} </b>as per your requirements.</p>
                                </div>

                                <div class="alert alert-danger" role="alert">
                                    <h6 class="alert-heading">Danger!</h6>
                                    <div class="alert-body">
                                        This action could cause to some task below!!
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Task</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Assignee</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serializedTasks = Session::get('tasksAction');
                                                // Unserialize the object
                                                $listTasks = unserialize($serializedTasks);
                                            @endphp
                                            @foreach ($listTasks as $t)
                                                <tr>
                                                    <td>
                                                        <span class="fw-bold">{{ $t->title }}</span>
                                                    </td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($t->start_date)) }}
                                                    </td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($t->due_date)) }}
                                                    </td>
                                                    <td>
                                                        @if (isset($t->assignTo->avatar))
                                                            <div class="avatar-group">
                                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-bs-placement="top" class="avatar pull-up my-0"
                                                                    title=""
                                                                    data-bs-original-title="{{ $t->assignTo->name }}">
                                                                    <img src="{{ asset('images/avatars/' . $t->assignTo->avatar) }}"
                                                                        alt="Avatar" height="26" width="26">
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="avatar-group">
                                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-bs-placement="top" class="avatar pull-up my-0"
                                                                    title=""
                                                                    data-bs-original-title="No assign to anyone yet">
                                                                    <img src="{{ asset('images/avatars/default.png') }}"
                                                                        alt="Avatar" height="26" width="26">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $badgeStt = '';
                                                            $statusNote = '';
                                                        @endphp
                                                        @switch($t->status)
                                                            @case(-1)
                                                                @php
                                                                    $badgeStt = 'danger';
                                                                    $statusNote = 'Done late';
                                                                @endphp
                                                            @break

                                                            @case(0)
                                                                @php
                                                                    $badgeStt = 'secondary';
                                                                    $statusNote = 'Todo';
                                                                @endphp
                                                            @break

                                                            @case(1)
                                                                @php
                                                                    $badgeStt = 'primary';
                                                                    $statusNote = 'Doing';
                                                                @endphp
                                                            @break

                                                            @case(2)
                                                                @php
                                                                    $badgeStt = 'warning';
                                                                    $statusNote = 'Reviewing';
                                                                @endphp
                                                            @break

                                                            @case(3)
                                                                @php
                                                                    $badgeStt = 'success';
                                                                    $statusNote = 'Success';
                                                                @endphp
                                                            @break

                                                            @default
                                                        @endswitch
                                                        <span
                                                            class="badge rounded-pill badge-light-{{ $badgeStt }} me-1">{{ $statusNote }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-2">
                                    <a type="button"
                                        href="{{ route('view.project.board', ['slug' => $project->slug]) }}"
                                        class="btn btn-primary">Check it
                                        out!!</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Change duration Modal -->
            @endif
            @include('content._partials._modals.modal-refer-earn')
            <!-- Tabs with Icon ends -->
        </div>
    </section>
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
