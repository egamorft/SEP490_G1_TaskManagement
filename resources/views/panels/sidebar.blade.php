@php
    $configData = Helper::applClasses();
@endphp

@if (Auth::check())
    <div class="main-menu menu-fixed {{ $configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark' ? 'menu-dark' : 'menu-light' }} menu-accordion menu-shadow"
        data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="brand-logo">
                            <svg width="75" height="38" viewBox="0 0 45 23" fill="none"
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
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                            data-ticon="disc"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                @if (Auth::user())
                    {{-- USER role -> Comp chung của user --}}
                    <li class="mt-2 nav-item {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                            <i data-feather="home"></i>
                            <span class="menu-title text-truncate">Dashboards</span>
                        </a>
                    </li>

                    @if (Auth::user()->is_admin == 1)
                        <li class="navigation-header">
                            <span>Settings</span>
                            <i data-feather="more-horizontal"></i>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() === 'admin-access-roles' ? 'active' : '' }}">
                            <a href="{{ route('admin-access-roles') }}" class="d-flex align-items-center">
                                <i data-feather="shield"></i>
                                <span class="menu-title text-truncate">Roles & Permission</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() === 'user-list' ? 'active' : '' }}">
                            <a href="{{ route('user-list') }}" class="d-flex align-items-center">
                                <i data-feather="user"></i>
                                <span class="menu-title text-truncate">User Management</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->is_admin == 0)
                        {{-- USER role -> Comp riêng của từng user --}}
                        {{-- Nav header --}}
                        <li class="nav-item mb-0">
                            <a data-bs-toggle="modal" data-bs-target="#addNewProject"
                                href="{{ isset($p->slug) ? url($p->slug) : 'javascript:void(0)' }}"
                                class="d-flex align-items-center" target="_self" style=" font-weight: bold">
                                <i data-feather='plus-square'></i>
                                <span class="menu-title text-truncate">Add new project</span>
                            </a>
                        </li>
                        <li class="navigation-header">
                            <span>My project</span>
                            <i data-feather="more-horizontal"></i>
                        </li>
                        {{-- Project List --}}
                        @foreach ($projects as $p)
                            @php
                                $logo = Str::substr($p->name, 0, 1) . '.png';
                                $currentUrl = request()->url();
                                $slug = Str::after($currentUrl, 'project/');
                                $slug = explode('/', $slug)[0];
                            @endphp
                            <li class="nav-item {{ $slug === $p->slug ? 'active' : '' }}">
                                <a href="{{ isset($p->slug) ? url(route('view.project.board', ['slug' => $p->slug])) : 'javascript:void(0)' }}"
                                    class="d-flex align-items-center" target="_self">
                                    <img class="rounded me-1"
                                        src="{{ Auth::user() ? asset('images/avatars/' . $logo) : '' }}" alt="avatar"
                                        height="25" width="25">
                                    <span class="menu-title text-truncate">{{ $p->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>

        @include('panels/reminderLayout')
    </div>

    
    <!-- END: Main Menu-->
    @include('content._partials._modals.modal-add-new-project')
@endif