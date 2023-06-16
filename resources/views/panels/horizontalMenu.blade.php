@php
    $configData = Helper::applClasses();
@endphp
{{-- Horizontal Menu --}}
<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal
  {{ $configData['horizontalMenuClass'] }}
  {{ $configData['theme'] === 'dark' ? 'navbar-dark' : 'navbar-light' }}
  navbar-shadow menu-border
  {{ $configData['layoutWidth'] === 'boxed' && $configData['horizontalMenuType'] === 'navbar-floating' ? 'container-xxl' : '' }}"
        role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="brand-logo">
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
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                {{-- Foreach menu item starts --}}
                @if (isset($menuData[1]))
                    @foreach ($menuData[1]->menu as $menu)
                        @php
                            $custom_classes = '';
                            if (isset($menu->classlist)) {
                                $custom_classes = $menu->classlist;
                            }
                        @endphp
                        <li class="nav-item @if (isset($menu->submenu)) {{ 'dropdown' }} @endif {{ $custom_classes }} {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }}"
                            @if (isset($menu->submenu)) {{ 'data-menu=dropdown' }} @endif>
                            <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                class="nav-link d-flex align-items-center @if (isset($menu->submenu)) {{ 'dropdown-toggle' }} @endif"
                                target="{{ isset($menu->newTab) ? '_blank' : '_self' }}"
                                @if (isset($menu->submenu)) {{ 'data-bs-toggle=dropdown' }} @endif>
                                <i data-feather="{{ $menu->icon }}"></i>
                                <span>{{ __('locale.' . $menu->name) }}</span>
                            </a>
                            @if (isset($menu->submenu))
                                @include('panels/horizontalSubmenu', ['menu' => $menu->submenu])
                            @endif
                        </li>
                    @endforeach
                @endif
                {{-- Foreach menu item ends --}}
            </ul>
        </div>
    </div>
</div>
