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

        <img src="{{ asset('backend/img/demo/avatars/profile.png') }}" class="profile-image rounded-circle"
            alt="Admin">
        <div class="info-card-text">
            <a href="#" class="d-flex align-items-center text-white">
                <span class="text-truncate text-truncate-sm d-inline-block">
                    {{ Auth::user()->name }}
                </span>
            </a>
        </div>
        <img src="{{ asset('backend/img/card-backgrounds/cover-7-lg.png') }}" class="cover" alt="cover">
    </div>
    <ul id="js-nav-menu" class="nav-menu">
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}" title="Dash Board" data-filter-tags="Dash Board">
                <i class="fal fa-home"></i>
                <span class="nav-link-text" data-i18n="nav.application_intel">Dashboard</span>
            </a>
        </li>
        @can('master-module')
            <li
                class="{{ request()->routeIs('department*') || request()->is('course*') || request()->is('semester*') || request()->is('paper*') || request()->is('papersubtype*') || request()->is('credit*') ? 'active open' : '' }}">
                <a href="#" title="Theme Settings" data-filter-tags="theme settings">
                    <i class="fa-solid fa-m"></i>
                    <span class="nav-link-text" data-i18n="nav.theme_settings">Masters</span>
                </a>
                <ul>
                    <li class="{{ request()->routeIs('department*') ? 'active' : '' }}">
                        <a href="{{ url('/department') }}" title="How it works"
                            data-filter-tags="theme settings how it works">
                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Department Master</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('course*') ? 'active' : '' }}">
                        <a href="{{ route('course.index') }}" title="course" data-filter-tags="theme settings how it works">

                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Course Master</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('semester*') ? 'active' : '' }}">
                        <a href="{{ route('semester.index') }}" title="How it works"
                            data-filter-tags="theme settings how it works">
                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Semester</span>
                        </a>
                    </li>
                    @can('paper-module')
                        {{-- <li class="{{ request()->routeIs('paper*') ? 'active' : '' }}">
                            <a href="{{ route('paper.index') }}" title="paper" data-filter-tags="theme settings how it works">
                                <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Paper Type</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('papersubtype*') ? 'active' : '' }}">
                            <a href="{{ route('papersubtype.index') }}" title="paper"
                                data-filter-tags="theme settings how it works">
                                <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Paper Sub Type</span>
                            </a>
                        </li> --}}
                        <li class="{{ request()->routeIs('paper*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" title="Menu child" data-filter-tags="utilities menu child">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Paper</span>
                            </a>
                            <ul>
                                <li class="{{ request()->is('paper') ? 'active' : '' }}">
                                    <a href="{{ route('paper.index') }}" title="Sublevel Item"
                                        data-filter-tags="utilities menu child sublevel item">
                                        <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Paper Type</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('papersubtype*') ? 'active' : '' }}">
                                    <a href="{{ route('papersubtype.index') }}" title="Another Item"
                                        data-filter-tags="utilities menu child another item">
                                        <span class="nav-link-text" data-i18n="nav.utilities_menu_child_another_item">Paper Sub Type</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('credit-module')
                        <li class="{{ request()->routeIs('credit*') ? 'active' : '' }}">
                            <a href="{{ route('credit.index') }}" title="paper"
                                data-filter-tags="theme settings how it works">
                                <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Credit Master</span>
                            </a>
                        </li>
                    @endcan




                </ul>
            </li>
        @endcan
        @can('user-module')
            <li class="{{ request()->routeIs('roles*') || request()->is('users*') ? 'active open' : '' }}">
                <a href="#" title="Theme Settings" data-filter-tags="theme settings">
                    <i class="fal fa-cog"></i>
                    <span class="nav-link-text" data-i18n="nav.user_management">User Management</span>
                </a>
                <ul>
                    @can('role-module')
                        <li class="{{ request()->routeIs('roles*') ? 'active' : '' }}">
                            <a href="{{ route('roles.index') }}" title="How it works"
                                data-filter-tags="theme settings how it works">
                                <span class="nav-link-text" data-i18n="nav.user_management_role">Role</span>
                            </a>
                        </li>
                    @endcan
                    <li class="{{ request()->routeIs('users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" title="Users" data-filter-tags="users">
                            <span class="nav-link-text" data-i18n="nav.user_management_user">Users</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('colleges.index') }}" title="Colleges" data-filter-tags="theme settings Colleges">
                            <span class="nav-link-text" data-i18n="nav.user_management_college">Colleges</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ route('students.index') }}" title="students"
                            data-filter-tags="theme settings students">
                            <span class="nav-link-text" data-i18n="nav.user_management_students">Students</span>
                        </a>
                    </li> --}}

                </ul>
            </li>
        @endcan
        @can('college-module')
            <li class="{{ request()->routeIs('colleges.index') ? 'active' : '' }}">
                <a href="{{ route('colleges.index') }}" title="Colleges" data-filter-tags="theme settings Colleges">
                    <i class="fa-solid fa-landmark"></i>
                    <span class="nav-link-text" data-i18n="nav.user_management_college">Colleges</span>
                </a>
            </li>
        @endcan

        @can('notice-module')
            <li class="{{ request()->is('notices*') ? 'active' : '' }}">
                <a href="{{ url('/notices') }}" title="Notices" data-filter-tags="Notice">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="nav-link-text" data-i18n="nav.application_notice">Notice</span>
                </a>
            </li>
        @endcan




        {{-- @can('master-module')
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
                    @can('credit-module')
                        <li>
                            <a href="{{ route('credit.index') }}" title="paper"
                                data-filter-tags="theme settings how it works">
                                <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Credit Master</span>
                            </a>
                        </li>
                    @endcan

                    <li>
                        <a href="{{ route('papersubtype.index') }}" title="paper"
                            data-filter-tags="theme settings how it works">
                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Paper Sub Type</span>
                        </a>
                    </li>


                </ul>
            </li>
        @endcan --}}

        @can('college-notice-module')
            <li class="{{ request()->is('academic-notices*') ? 'active' : '' }}">
                <a href="{{ url('/academic-notices') }}" title="Notices" data-filter-tags="Notice">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="nav-link-text" data-i18n="nav.application_notice">Notices </span>
                    <span
                        class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">{{ Auth::user()->unreadNotifications->count() > 0 ? Auth::user()->unreadNotifications->count() : '' }}</span>
                </a>
            </li>
        @endcan

        @can('admission-module')
            <li class="{{ request()->is('new-admission*') || request()->is('uuc-admission*') ? 'active open' : '' }}">
                <a href="#" title="Theme Settings" data-filter-tags="theme settings">
                    <i class="fal fa-cog"></i>
                    <span class="nav-link-text" data-i18n="nav.user_management">Admissions</span>
                </a>
                <ul>
                    <li class="{{ request()->is('new-admission') ? 'active' : '' }}">
                        <a href="{{ url('/new-admission') }}" title="Admission" data-filter-tags="Admission">
                            <i class="fa-solid fa-book-open-reader"></i>
                            <span class="nav-link-text" data-i18n="nav.application_admission">New Admission</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('uuc-admission') ? 'active' : '' }}">
                        <a href="{{ url('/uuc-admission') }}" title="Admission" data-filter-tags="Admission">
                            <i class="fa-solid fa-book-open-reader"></i>
                            <span class="nav-link-text" data-i18n="nav.application_admission">Admission List</span>
                        </a>
                    </li>

                </ul>
            </li>
        @endcan

        @can('verify-admission-module')
            @php
                $student_app = App\Helpers\Helpers::application();
            @endphp
            <li class="{{ request()->is('applied-admission-list*') ? 'active open' : '' }}">
                <a href="#" title="Theme Settings" data-filter-tags="theme settings">
                    <i class="fal fa-cog"></i>
                    <span class="nav-link-text" data-i18n="nav.user_management">Admissions</span>
                    @if ($student_app['all_app'] > 0)
                        <span
                            class="dl-ref bg-danger-500 hidden-nav-function-minify hidden-nav-function-top">{{ $student_app['all_app'] }}</span>
                    @endif

                </a>
                <ul>
                    <li class="{{ request()->is('applied-admission-list/ug') ? 'active' : '' }}">
                        <a href="{{ url('/applied-admission-list/ug') }}" title="Admission"
                            data-filter-tags="Admission">

                            <span class="nav-link-text" data-i18n="nav.application_admission">UG</span>
                            @if ($student_app['ug'] > 0)
                                <span
                                    class="dl-ref bg-danger-500 hidden-nav-function-minify hidden-nav-function-top">{{ $student_app['ug'] }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="{{ request()->is('applied-admission-list/pg') ? 'active' : '' }}">
                        <a href="{{ url('/applied-admission-list/pg') }}" title="Admission"
                            data-filter-tags="Admission">

                            <span class="nav-link-text" data-i18n="nav.application_admission">PG</span>
                            @if ($student_app['pg'] > 0)
                                <span
                                    class="dl-ref bg-danger-500 hidden-nav-function-minify hidden-nav-function-top">{{ $student_app['pg'] }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="{{ request()->is('applied-admission-list/certificate') ? 'active' : '' }}">
                        <a href="{{ url('/applied-admission-list/certificate') }}" title="Admission"
                            data-filter-tags="Admission">

                            <span class="nav-link-text" data-i18n="nav.application_admission">Certificate</span>
                            @if ($student_app['certificate'] > 0)
                                <span
                                    class="dl-ref bg-danger-500 hidden-nav-function-minify hidden-nav-function-top">{{ $student_app['certificate'] }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="{{ request()->is('applied-admission-list') ? 'active' : '' }}">
                        <a href="{{ url('/applied-admission-list') }}" title="Admission" data-filter-tags="Admission">
                            <span class="nav-link-text" data-i18n="nav.application_admission">Application Status</span>
                        </a>
                    </li>

                </ul>
            </li>
            {{-- <li>
                <a href="{{ url('/applied-admission-list') }}" title="Admission" data-filter-tags="Admission">
                    <i class="fa-solid fa-book-open-reader"></i>
                    <span class="nav-link-text" data-i18n="nav.application_admission">Admissions-Old</span>
                </a>
            </li> --}}
        @endcan
        @can('uuc-student-module')
            <li class="{{ request()->is('uuc-students*') ? 'active' : '' }}">
                <a href="{{ url('/uuc-students') }}" title="Student Details" data-filter-tags="Admission">
                    <i class="fas fa-user-graduate"></i>
                    <span class="nav-link-text" data-i18n="nav.application_admission">UUC Students</span>
                </a>
            </li>
        @endcan
        {{-- UUC PG ADMISSION --}}
        @can('uuc-pg-admission-module')
        <li class="{{ request()->is('uuc-pg-admission/*') ? 'active' : '' }}">
            <a href="{{ route('pgadmissionList') }}" title="Student Details" data-filter-tags="Admission">
                <i class="fas fa-user-graduate"></i>
                <span class="nav-link-text" data-i18n="nav.application_admission">UUC PG Students</span>
            </a>
        </li>
        <li class="{{ request()->is('finalAdmissionList/*') ? 'active' : '' }}">
            <a href="{{ route('finalAdmissionList') }}" title="Student Details" data-filter-tags="Admission">
                <i class="fas fa-book-open-reader"></i>
                <span class="nav-link-text" data-i18n="nav.application_admission">UUC PG Admission List</span>
            </a>
        </li>
        @endcan
        {{-- ENDS HERE --}}
        @can('student-module')
            <li class="{{ request()->is('college-students*') ? 'active' : '' }}">
                <a href="{{ url('/college-students') }}" title="Student Details" data-filter-tags="Admission">
                    <i class="fa-solid fa-book-open-reader"></i>
                    <span class="nav-link-text" data-i18n="nav.application_admission">Students</span>
                </a>
            </li>
        @endcan
        @can('student-details-module')
            <li class="{{ request()->routeIs('exam_notice') ? 'active' : '' }}">
                <a href="{{ route('exam_notice') }}" title="Student Details" data-filter-tags="Admission">
                    <i class="fa-solid fa-book-open-reader"></i>
                    <span class="nav-link-text" data-i18n="nav.application_admission">Exam Notice</span>
                </a>
            </li>
        @endcan

        @can('course-structure-module')
            <li class="{{ request()->is('academic-course-structure*') ? 'active' : '' }}">
                <a href="{{ url('/academic-course-structure') }}" title="Admission" data-filter-tags="Admission">
                    <i class="fa-solid fa-book-open"></i>
                    <span class="nav-link-text" data-i18n="nav.application_admission">Course Structure</span>
                </a>
            </li>
        @endcan
        @can('course-maped-module')
            <li class="{{ request()->is('maped-course*') ? 'active' : '' }}">
                <a href="{{ url('/maped-course') }}" title="Admission" data-filter-tags="Admission">
                    <i class="fas fa-atlas"></i>
                    <span class="nav-link-text" data-i18n="nav.application_admission">Maped Course</span>
                </a>
            </li>
        @endcan





    </ul>
    <div class="filter-message js-filter-message bg-success-600"></div>
</nav>
<!-- END PRIMARY NAVIGATION -->
