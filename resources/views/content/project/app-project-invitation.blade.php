@extends('layouts/contentLayoutMaster')

@section('title', 'Project Invitation')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice.css') }}">
@endsection

@section('content')
    <section class="invoice-preview-wrapper">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div
                class="{{ isset($check_account_project_invitation_valid) ? 'col-xl-9 col-md-8' : 'col-xl-12 col-md-12' }} col-12">
                <div class="card invoice-preview-card">
                    <div class="card-body invoice-padding pb-0">
                        <!-- Header starts -->
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="logo-wrapper">
                                        <svg width="100" height="100" viewBox="0 0 45 23" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_104_129874)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M41 15.6875L40.5 17.6892C40.5 17.6892 40.5 21.9506 40.5 23.1875H41.2774L41.7218 21.6875L42.5 23.1875H45L41.2774 20.0613L44 18.6872L44.5 16.626L41.2774 18.6872L41.7218 16.626L41 15.6875Z"
                                                    fill="#4267B2" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M36.5 15.1875L36 17.1875L36.5 20.1875C36.5 20.1875 38.2778 19.7232 38.2778 20.9601V22.1875L36 21.6875L36.5 23.1875H39L40 21.1875V20.0613L38.2778 18.7812L37.2774 18.6872L37.7218 16.626L38.608 17.6892L40 16.6875L38.6111 15.1875H36.5Z"
                                                    fill="#4267B2" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M32 15.6875L31.5 17.6892C31.5 17.6892 31.5 21.9506 31.5 23.1875H32.2774V20.0613H33.608L33.2778 18.7812L32.2774 18.6872L32.7218 16.626L34.3889 23.0886H35.5L33.6111 15.1875L32 15.6875Z"
                                                    fill="#4267B2" />
                                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.9119 19.3717L0.661865 22.8156H35.7354H59.5589L45.0001 19.3717H11.9119Z"
                                                    fill="#161616" />
                                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M19.1912 15.9279V17.8958L23.5147 17.2398L28.4559 17.8958V17.2398V15.9279L23.5147 16.5838L19.1912 15.9279Z"
                                                    fill="#161616" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0.5 0V7.1923C0.5 7.1923 0.5 19.444 0.5 23H6.98676L3.74259 14.0121L15.7924 13.5182L16.7433 10.0615H3.74259L5.5964 4.13572L16.7433 7.1923L19.5 0.185181L0.5 0Z"
                                                    fill="url(#paint0_linear_104_129874)" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M24.5 18.1875L25.2273 7.1875H20.5L21.5909 3.6875L36.5 0.1875L34.6818 7.1875H28.5C28.5 7.1875 27.0455 9.1875 28.5 12.1875L29.2273 23.1875H25.4091H21.5909L24.5 18.1875Z"
                                                    fill="#28C76F" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M24.5 18.1875L25.2273 7.1875H20.5L21.5909 3.6875L36.5 0.1875L34.6818 7.1875H28.5C28.5 7.1875 27.0455 9.1875 28.5 12.1875L29.2273 23.1875H25.4091H21.5909L24.5 18.1875Z"
                                                    fill="black" fill-opacity="0.25" />
                                            </g>
                                            <defs>
                                                <linearGradient id="paint0_linear_104_129874" x1="0.5" y1="23"
                                                    x2="23.0865" y2="4.34157" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FF9F43" />
                                                    <stop offset="1" stop-color="#FFB976" />
                                                </linearGradient>
                                                <clipPath id="clip0_104_129874">
                                                    <rect width="45" height="23" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <p style="width: 300px" class="card-text mb-25 text-wrap">
                                    <p style="text-align: left"
                                        class="
                                    @if ($project->project_status == 1) text-success
                                    @elseif ($project->project_status == -1)
                                        text-danger @endif">
                                        --------------------------------------</p>
                                    <p
                                        class="
                                    @if ($project->project_status == 1) text-success
                                    @elseif ($project->project_status == -1)
                                        text-danger @endif">
                                        {{ $project->description != null ? $project->description : '#No-description' }}</p>
                                    </p>
                                    <p
                                        class="
                                    @if ($project->project_status == 1) text-success
                                    @elseif ($project->project_status == -1)
                                        text-danger @endif">
                                        @if ($project->project_status == 1)
                                            Approved by
                                        @elseif($project->project_status == -1)
                                            Rejected by
                                        @else
                                            Incharge by
                                        @endif
                                        <br /><strong>{{ $supervisorAccounts->email }}</strong>
                                    </p>
                                </div>
                                <div class="mt-md-0 mt-2 col-md-5">
                                    <h4 class="fw-bold text-uppercase mt-5 me-5 fs-2">
                                        {{ $project->name }}
                                    </h4>
                                </div>
                                <div class="mt-md-0 mt-2 col-md-2">
                                    <h4 class="invoice-title">
                                        <span class="invoice-number">#{{ $project->slug }}</span>
                                    </h4>
                                    <div class="invoice-date-wrapper">
                                        <p class="invoice-date-title">Date Start:</p>
                                        <p class="invoice-date">{{ date('d/m/Y', strtotime($project->start_date)) }}</p>
                                    </div>
                                    <div class="invoice-date-wrapper">
                                        <p class="invoice-date-title">Due Date:</p>
                                        <p class="invoice-date">{{ date('d/m/Y', strtotime($project->end_date)) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Header ends -->
                    </div>

                    <hr class="invoice-spacing" />

                    <div class="px-sm-5 mx-50 pb-2">

                        <p class="fw-bolder pt-50">{{ $totalAccounts }} Members</p>

                        <!-- member's list  -->
                        <ul class="list-group list-group-flush mb-2">
                            @foreach ($accountsInProject as $acc)
                                <li class="list-group-item d-flex align-items-start border-0 px-0">
                                    <div class="avatar me-75">
                                        <img src="{{ asset('images/avatars/' . $acc['accountAvatar']) }}" alt="avatar"
                                            width="38" height="38" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="me-1">
                                            <h5 class="mb-25">{{ $acc['accountName'] }}</h5>
                                            <span>{{ $acc['accountEmail'] }}</span>
                                        </div>

                                        <div class="dropdown">
                                            <button class="btn btn-flat-secondary" type="button" id="member1"
                                                aria-expanded="false">
                                                <span class="d-none d-lg-inline-block">{{ $acc['roleName'] }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!--/ member's list  -->
                    </div>

                    <hr class="invoice-spacing" />

                    <!-- Invoice Note starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">Note:</span>
                                <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                                    future freelance
                                    projects. Thank You!</span>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Note ends -->
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            @if (isset($check_account_project_invitation_valid))
                <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                    <div class="card">
                        <form method="POST"
                            action="{{ route('invitation.submit', ['slug' => $project->slug, 'token' => $project->token]) }}">
                            @csrf
                            <div class="card-body">
                                <button type="submit" name="approve" value="1"
                                    class="btn btn-success w-100 mb-75">
                                    Accept
                                </button>
                                <button type="submit" name="decline" value="1" class="btn btn-danger w-100">
                                    Decline
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <!-- /Invoice Actions -->
        </div>
    </section>
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('js/scripts/pages/app-invoice.js') }}"></script>
@endsection
