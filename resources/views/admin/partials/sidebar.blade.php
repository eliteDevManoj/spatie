<div class="sidebar border-right d-flex flex-column" style="height: 100vh;">
    <h6 class="text-center">{{ isset($user->name) ? $user->name : '' }}</h6>
    <p style="text-align: center; font-size: 14px; font-weight: 600;">
        {{ isset($userRoles[0]) ? $userRoles[0] : '' }}
    </p>
    <hr>
        <ul class="list-unstyled">
            <li class="sidebar-item"> 
                <a href="#" class="nav-link toggle-subitems">
                    <i class="fa-solid fa-users" style="margin-right: 3px;"></i>
                    
                        Roles
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="list-unstyled sub-items" style="display: none;">

                    @can('create role')
                        <li><a href="{{ route('roles.create') }}" class="nav-link" style="text-align: center; margin-right: 25%; font-size: 14px; font-family: serif;">Create</a></li>
                    @endcan

                    @can('manage role')
                        <li><a href="{{ route('roles') }}" class="nav-link" style="text-align: center; margin-right: 25%; font-size: 14px; font-family: serif;">Manage</a></li>
                    @endcan
                </ul>
            </li>

            <li class="sidebar-item"> 
                <a href="#" class="nav-link toggle-subitems">
                <i class="fa-solid fa-shield" style="margin-right: 3px;"></i>
                        Permissions
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="list-unstyled sub-items" style="display: none;">

                    @can('create permission')
                        <li><a href="{{ route('permissions.create') }}" class="nav-link" style="text-align: center; margin-right: 25%; font-size: 14px; font-family: serif;">Create</a></li>
                    @endcan

                    @can('manage permission')
                        <li><a href="{{ route('permissions') }}" class="nav-link" style="text-align: center; margin-right: 25%; font-size: 14px; font-family: serif;">Manage</a></li>
                    @endcan
                </ul>
            </li>

            <li class="sidebar-item"> 
                <a href="#" class="nav-link toggle-subitems">
                    <i class="fa-solid fa-user-gear" style="margin-right: 3px;"></i>
                        Users
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="list-unstyled sub-items" style="display: none;">

                    @can('create user')
                        <li><a href="{{ route('users.create') }}" class="nav-link" style="text-align: center; margin-right: 25%; font-size: 14px; font-family: serif;">Create</a></li>
                    @endcan

                    @can('manage user')
                    <li><a href="{{ route('users') }}" class="nav-link" style="text-align: center; margin-right: 25%; font-size: 14px; font-family: serif;">Manage</a></li>
                    @endcan
                </ul>
            </li>
        </ul>

        <!-- Logout Button -->
        <div class="logout-container mt-auto text-center" style="border-top: 1px solid #315274;padding-top: 15px;">
            <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100" style="border: 2px solid #fff; color: white">
                <i class="fa-regular fa-circle-left" style="margin-right: 5px;"></i>Logout
            </a>
        </div>
</div>