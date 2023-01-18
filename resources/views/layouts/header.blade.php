<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ asset('backend/img/favicon/favicon.png') }}" alt=" Utkal University of Culture"
                aria-roledescription="logo">
            <span class="page-logo-text mr-1"> Utkal University of Culture</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden"
            title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify"
                    title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed"
                    title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>
    <div class="search">
        <form class="app-forms hidden-xs-down" role="search" action="page_search.html" autocomplete="off">
            <input type="text" id="search-field" placeholder="Search for anything" class="form-control"
                tabindex="1">
            <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none"
                data-action="toggle" data-class="mobile-search-on">
                <i class="fal fa-times"></i>
            </a>
        </form>
    </div>
    <div class="ml-auto d-flex">
        <!-- activate app search icon (mobile) -->
        <div class="hidden-sm-up">
            <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on"
                data-focus="search-field" title="Search">
                <i class="fal fa-search"></i>
            </a>
        </div>
        <!-- app settings -->
        <div class="hidden-md-down">
            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                <i class="fal fa-cog"></i>
            </a>
        </div>
        @if (Auth::user()->role_id == 3 ||
            Auth::user()->role_id == 10 ||
            Auth::user()->role_id == 12 ||
            Auth::user()->role_id == 13 ||
            Auth::user()->role_id == 14)
            <div>
                <a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">
                    <i class="fal fa-bell"></i>
                    <span class="badge badge-icon">{{ Auth::user()->unreadNotifications->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
                    <div
                        class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
                        <h4 class="m-0 text-center color-white">

                            <small class="mb-0">{{ Auth::user()->unreadNotifications->count() }} New
                                Notifications</small>
                        </h4>
                    </div>
                    <div class="custom-scroll h-100">
                        <ul class="notification">

                            @foreach (Auth::user()->unreadNotifications as $notification)
                                <li class="unread">
                                    <div class="d-flex align-items-center show-child-on-hover">
                                        @php
                                            if ($notification['data']['notice_type'] == 'Admission Notice') {
                                                $url = url('uuc-admission/'.$notification['data']['notice_id'].'/'. str_slug($notification['data']['department']) .'/'.$notification['data']['department_id']);
                                            }elseif ($notification['data']['notice_type'] == 'Exam Notice') {
                                                $url = url('uuc-examination');
                                            }else{
                                                $url = '';

                                            }
                                        @endphp
                                        <a href="{{ $url }}">
                                            <span class="d-flex flex-column flex-1">
                                                <span
                                                    class="name d-flex align-items-center">{{ $notification['data']['notice_type'] }}
                                                    <span class="badge badge-success fw-n ml-1">New</span></span>
                                                <span class="msg-a fs-sm">
                                                    {{ $notification['data']['details'] }}
                                                </span>
                                                {{-- <span class="fs-nano text-muted mt-1">5 mins ago</span> --}}
                                            </span>
                                        </a>

                                    </div>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                    {{-- <div
                    class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
                    <a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
                </div> --}}
                </div>
            </div>
        @endif

        <!-- app user menu -->
        <div>
            <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                class="header-icon d-flex align-items-center justify-content-center ml-2">
                <img src="{{ asset('backend/img/demo/avatars/avatar-admin.png') }}" class="profile-image rounded-circle"
                    alt="Admin">
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            <img src="{{ asset('backend/img/demo/avatars/avatar-admin.png') }}"
                                class="rounded-circle profile-image" alt="Admin">
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">{{ Auth::user()->name }}</div>
                            <span class="text-truncate text-truncate-md opacity-80">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider m-0"></div>
                <a href="#" class="dropdown-item" data-action="app-reset">
                    <span data-i18n="drpdwn.reset_layout">Reset Layout</span>
                </a>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                    <span data-i18n="drpdwn.settings">Settings</span>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a href="#" class="dropdown-item" data-action="app-fullscreen">
                    <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                    <i class="float-right text-muted fw-n">F11</i>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item fw-500 pt-3 pb-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <span data-i18n="drpdwn.page-logout">Logout</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </div>
        </div>
    </div>
</header>
<!-- END Page Header -->
