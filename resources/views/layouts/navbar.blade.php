<!-- BEGIN PRIMARY NAVIGATION -->
<nav id="js-primary-nav" class="primary-nav" role="navigation">
    <div class="nav-filter">
        <div class="position-relative">
            <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
            <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                <i class="fal fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="info-card">

        <img src="{{ asset('backend/img/demo/avatars/avatar-admin.png') }}" class="profile-image rounded-circle"
            alt="Admin">
        <div class="info-card-text">
            <a href="#" class="d-flex align-items-center text-white">
                <span class="text-truncate text-truncate-sm d-inline-block">
                    {{ Auth::user()->name }}
                </span>
            </a>

        </div>
        <img src="{{ asset('backend/img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
    </div>
    <ul id="js-nav-menu" class="nav-menu">
        <li class="active open">
            <a href="{{ url('/dashboard') }}" title="Dash Board" data-filter-tags="Dash Board">
                <i class="fal fa-home"></i>
                <span class="nav-link-text" data-i18n="nav.application_intel">Dashboard</span>
            </a>
        </li>
        @can('college-module')
            <li class="">
                <a href="{{ route('colleges.index') }}" title="Colleges" data-filter-tags="theme settings Colleges">
                    <i class="fa-solid fa-landmark"></i>
                    <span class="nav-link-text" data-i18n="nav.user_management_college">Colleges</span>
                </a>
            </li>
        @endcan

        @can('notice-module')
            <li>
                <a href="{{ url('/notices') }}" title="Notices" data-filter-tags="Notice">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="nav-link-text" data-i18n="nav.application_notice">Notice</span>
                </a>
            </li>
        @endcan

        @can('user-module')
            <li>
                <a href="#" title="Theme Settings" data-filter-tags="theme settings">
                    <i class="fal fa-cog"></i>
                    <span class="nav-link-text" data-i18n="nav.user_management">User Management</span>
                </a>
                <ul>
                    @can('role-module')
                        <li>
                            <a href="{{ route('roles.index') }}" title="How it works"
                                data-filter-tags="theme settings how it works">
                                <span class="nav-link-text" data-i18n="nav.user_management_role">Role</span>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a href="{{ route('users.index') }}" title="Users" data-filter-tags="users">
                            <span class="nav-link-text" data-i18n="nav.user_management_user">Users</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('colleges.index') }}" title="Colleges" data-filter-tags="theme settings Colleges">
                            <span class="nav-link-text" data-i18n="nav.user_management_college">Colleges</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('students.index') }}" title="students" data-filter-tags="theme settings students">
                            <span class="nav-link-text" data-i18n="nav.user_management_students">Students</span>
                        </a>
                    </li>

                </ul>
            </li>
        @endcan


        @can('master-module')
            <li>
                <a href="#" title="Theme Settings" data-filter-tags="theme settings">
                    <i class="fa-solid fa-m"></i>
                    <span class="nav-link-text" data-i18n="nav.theme_settings">Masters</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ url('/department') }}" title="How it works"
                            data-filter-tags="theme settings how it works">
                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Department Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('course.index') }}" title="course"
                            data-filter-tags="theme settings how it works">

                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Course Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('semester.index') }}" title="How it works"
                            data-filter-tags="theme settings how it works">
                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Semester</span>
                        </a>
                    </li>
                    @can('paper-module')
                        <li>
                            <a href="{{ route('paper.index') }}" title="paper" data-filter-tags="theme settings how it works">
                                <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Paper Type</span>
                            </a>
                        </li>
                    @endcan

                    <li>
                        <a href="{{ route('credit.index') }}" title="paper"
                            data-filter-tags="theme settings how it works">
                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Credit Master</span>
                        </a>
                    </li>


                </ul>
            </li>
        @endcan

        @can('college-notice-module')
            <li>
                <a href="{{ url('/academic-notices') }}" title="Notices" data-filter-tags="Notice">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="nav-link-text" data-i18n="nav.application_notice">Notices </span>
                    <span
                        class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">{{ Auth::user()->unreadNotifications->count() > 0 ? Auth::user()->unreadNotifications->count() : '' }}</span>
                </a>
            </li>
        @endcan

        @can('admission-module')
            <li>
                <a href="{{ url('/uuc-admission') }}" title="Admission" data-filter-tags="Admission">
                    <i class="fa-solid fa-book-open-reader"></i>
                    <span class="nav-link-text" data-i18n="nav.application_admission">Admissions</span>
                </a>
            </li>
        @endcan

        @can('verify-admission-module')
            <li>
                <a href="{{ url('/applied-admission-list') }}" title="Admission" data-filter-tags="Admission">
                    <i class="fa-solid fa-book-open-reader"></i>
                    <span class="nav-link-text" data-i18n="nav.application_admission">Verify Admissions</span>
                </a>
            </li>
        @endcan



    </ul>
    <div class="filter-message js-filter-message bg-success-600"></div>
</nav>
<!-- END PRIMARY NAVIGATION -->
