@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
        data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <svg width="75" height="53" viewBox="0 0 45 23" fill="none"
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
            </ul>
        </div>
    @else
        <nav
            class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
@endif
<div class="navbar-container d-flex content">
    <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
            <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                        data-feather="menu"></i></a></li>
        </ul>
        <ul class="nav navbar-nav bookmark-icons">
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link" href="{{ url('chatify') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="Chat">
                    <i class="ficon" data-feather="message-square"></i>
                    <div class="pending-div">
                        
                    </div>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/calendar') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon"
                        data-feather="calendar"></i></a></li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/todo') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon"
                        data-feather="check-square"></i></a></li>
        </ul>
    </div>
    <ul class="nav navbar-nav align-items-center ms-auto">
        <li class="nav-item dropdown dropdown-language">
            <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                aria-haspopup="true">
                <i class="flag-icon flag-icon-us"></i>
                <span class="selected-language">English</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
                    <i class="flag-icon flag-icon-us"></i> English
                </a>
                <a class="dropdown-item" href="{{ url('lang/vi') }}" data-language="vi">
                    <i class="flag-icon flag-icon-vn"></i> Tiếng Việt
                </a>
            </div>
        </li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                    data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i></a></li>
        @if (Auth::check())
            <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i>
                    <div class="pending-div-noti">
                        
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                            <div class="pending-div-noti-badge">

                            </div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar">
                                        <img src="{{ asset('images/portrait/small/avatar-s-15.jpg') }}"
                                            alt="avatar" width="32" height="32">
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Congratulation Sam
                                            🎉</span>winner!</p>
                                    <small class="notification-text"> Won the monthly best seller badge.</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer">
                        <a class="btn btn-primary w-100" href="javascript:void(0)">Read all notifications</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
                    data-bs-toggle="dropdown" aria-haspopup="true">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">
                            @if (Auth::check())
                                {{ Auth::user()->name }}
                            @else
                                Who are you?
                            @endif
                        </span>
                        <span class="user-status">
                            @if (Auth::user()->is_admin == 1)
                                Admin
                            @else
                                User
                            @endif
                        </span>
                    </div>
                    <span class="avatar">
                        <img class="round"
                            src="{{ Auth::user() ? asset('images/avatars/' . Auth::user()->avatar) : Auth::user() }}"
                            alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <h6 class="dropdown-header">Manage Profile</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"
                        href="{{ Route::has('edit.profile') ? route('edit.profile') : 'javascript:void(0)' }}">
                        <i class="me-50" data-feather="user"></i> Profile
                    </a>
                    @if (Auth::check())
                        <a class="dropdown-item"
                            href="{{ Route::has('logout') ? route('logout') : 'javascript:void(0)' }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="power"></i> Logout
                        </a>
                        <form method="POST" id="logout-form"
                            action="{{ Route::has('logout') ? route('logout') : 'javascript:void(0)' }}">
                            @csrf
                        </form>
                    @else
                        <a class="dropdown-item"
                            href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
                            <i class="me-50" data-feather="log-in"></i> Login
                        </a>
                    @endif
                </div>
            </li>
        @else
            <li class="nav-item me-50">
                <a href="{{ route('login') }}" class="btn btn-outline-primary round waves-effect">Sign in</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="btn btn-outline-primary round waves-effect">Sign up</a>
            </li>
        @endif
    </ul>
</div>
</nav>
@if (Session::has('check-auth-first-time'))
    <div id="check-auth-first-time"></div>
@endif
{{-- Search Ends --}}
<!-- END: Header-->
