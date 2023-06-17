@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')


{{-- vendor css files --}}
@section('vendor-style')
@endsection

{{-- Page Css files --}}
@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="#">
                <svg width="75" height="53" viewBox="0 0 45 23" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                            d="M11.9119 19.3717L0.661865 22.8156H35.7354H59.5589L45.0001 19.3717H11.9119Z" fill="#161616" />
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
                        <linearGradient id="paint0_linear_104_129874" x1="0.5" y1="23" x2="23.0865"
                            y2="4.34157" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FF9F43" />
                            <stop offset="1" stop-color="#FFB976" />
                        </linearGradient>
                        <clipPath id="clip0_104_129874">
                            <rect width="45" height="23" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </a>
            <!-- /Brand logo-->

            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                    @if ($configData['theme'] === 'dark')
                        <img class="img-fluid" src="{{ asset('images/pages/register-v2-dark.svg') }}" alt="Register V2" />
                    @else
                        <img class="img-fluid" src="{{ asset('images/pages/register-v2.svg') }}" alt="Register V2" />
                    @endif
                </div>
            </div>
            <!-- /Left Text-->

            <!-- Register-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Adventure starts here 🚀</h2>
                    <p class="card-text mb-2">Make your task management easy and fun!</p>
                    <form class="auth-register-form mt-2" action="{{ route('create.account') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="register-email">Email</label>
                            <input class="form-control" id="register-email" type="text" name="register-email"
                                placeholder="your_email@example.com" aria-describedby="register-email" tabindex="1"
                                autofocus="" value="{{ old('register-email') }}" />
                        </div>
                        @error('register-email')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                        <div class="mb-1">
                            <label class="form-label" for="register-fullname">Full name</label>
                            <input class="form-control" id="register-fullname" type="text" name="register-fullname"
                                placeholder="Enter your fullname" aria-describedby="register-fullname" tabindex="2"
                                value="{{ old('register-fullname') }}" />
                        </div>
                        @error('register-fullname')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                        <div class="mb-1">
                            <label class="form-label" for="register-password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="register-password" type="password"
                                    name="register-password" placeholder="············"
                                    aria-describedby="register-password" tabindex="3" title="You must have minimum 8 characters long, uppercase & symbol" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        @error('register-password')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                        <div class="mb-1">
                            <label class="form-label" for="register-confirm-password">Confirm password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="register-confirm-password"
                                    type="password" name="register-confirm-password" placeholder="············"
                                    aria-describedby="register-password" tabindex="4" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        @error('register-confirm-password')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="btn btn-primary w-100" tabindex="5">Sign up</button>
                    </form>
                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        <a href="{{ url('login') }}"><span>&nbsp;Sign in instead</span></a>
                    </p>
                    <div class="divider my-2">
                        <div class="divider-text">or</div>
                    </div>
                    <div class="auth-footer-btn d-flex justify-content-center">
                        <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a>
                        <a class="btn btn-google" href="#"><i data-feather="mail"></i></a>
                    </div>
                </div>
            </div>
            <!-- /Register-->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('js/scripts/pages/auth-register.js') }}"></script>
@endsection
