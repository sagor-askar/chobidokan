<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw fas fa-users">

                    </i>
                    <span>{{ trans('cruds.userManagement.title') }}</span>
                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                        <a href="{{ route("admin.permissions.index") }}">
                            <i class="fa-fw fas fa-unlock-alt">

                            </i>
                            <span>{{ trans('cruds.permission.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                        <a href="{{ route("admin.roles.index") }}">
                            <i class="fa-fw fas fa-briefcase">

                            </i>
                            <span>{{ trans('cruds.role.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('user_access')
                    <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                        <a href="{{ route("admin.users.index") }}">
                            <i class="fa-fw fas fa-user">

                            </i>
                            <span>{{ trans('cruds.user.title') }}</span>

                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- website management --}}
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw fa fa-globe">

                    </i>
                    <span>Website Management</span>
                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">

                    <li class="">
                        <a href="">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            <span>Contact Info</span>
                        </a>
                    </li>

                    <li class="{{ request()->is("admin/faqs") || request()->is("admin/faqs/*") ? "active" : "" }}">
                        <a href="{{ route("admin.faqs.index") }}">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            <span>FAQs</span>
                        </a>
                    </li>

                    <li class="{{ request()->is("admin/testimonials") || request()->is("admin/testimonials/*") ? "active" : "" }}">
                        <a href="{{ route("admin.testimonials.index") }}">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            <span>Testimonials</span>
                        </a>
                    </li>

                </ul>
            </li>


            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
            <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                <a href="{{ route('profile.password.edit') }}">
                    <i class="fa-fw fas fa-key">
                    </i>
                    {{ trans('global.change_password') }}
                </a>
            </li>
            @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>
