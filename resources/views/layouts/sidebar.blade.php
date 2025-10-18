<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href="{{ route('admin.dashboard') }}">
            <span class="sidebar-brand-text align-middle">
                {{ env('APP_NAME') }}
                <sup><small class="badge bg-primary text-uppercase">Pro</small></sup>
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5"
                stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    @php
                        $profilePic = url('img/avatars/dummyavatar.png');
                        if (!empty(auth()->user()->image)) {
                            //$profilePic = Storage::disk('s3')->url(auth()->user()->image);
                            $profilePic = Storage::disk('s3')->temporaryUrl(auth()->user()->image, now()->addMinutes(120));
                        }
                    @endphp
                    <img src="{{ $profilePic }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        @if(canDo('permissions','can_view'))
                            <a class='dropdown-item' href="{{ route('admin.profile') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Log out</a>
                    </div>

                    <div class="sidebar-user-subtitle">{{ auth()->user()->role->name }}</div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                <!-- Pages -->
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class='sidebar-link' href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-money-check"></i>
                    <span class="align-middle">Dashboards</span>
                </a>
            </li>
            
            @if(canDo('permissions','can_add'))
                <li class="sidebar-item {{ request()->routeIs('admin.role-permissions') ? 'active' : '' }}">
                    <a class='sidebar-link' href="{{ route('admin.role-permissions') }}">
                        <i class="fas fa-user-lock"></i>
                        <span class="align-middle">Roles & Permissions</span>
                    </a>
                </li>
            @endif

            @if(canDo('users','can_view_nav'))
                <li class="sidebar-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                    <a class='sidebar-link' href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="align-middle">Users</span>
                    </a>
                </li>
            @endif
            
            @if(canDo('customers','can_add'))
                <li class="sidebar-item {{ request()->routeIs('admin.customers.index') ? 'active' : '' }}">
                    <a class='sidebar-link' href="{{ route('admin.customers.index') }}">
                        <i class="fas fa-user-tie"></i>
                        <span class="align-middle">Customers</span>
                    </a>
                </li>
            @endif
            
            @if(auth()->user()->role->slug == 'customer' && canDo('ledgers','can_view'))
                <li class="sidebar-item {{ request()->routeIs('admin.customers.index') ? 'active' : '' }}">
                    <a class='sidebar-link' href="{{ url('admin/customers/'.auth()->user()->customer->id.'/ledger' ) }}">
                        <i class="fas fa-user-tie"></i>
                        <span class="align-middle">Ledger</span>
                    </a>
                </li>
            @endif

            <li class="sidebar-item {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.branches.index') }}">
                    <i class="fa-solid fa-shop"></i>
                    <span class="align-middle">Branches</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <a data-bs-target="#forms" data-bs-toggle="collapse" class="sidebar-link {{ request()->routeIs('admin.products.*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('admin.products.*') ? 'true' : 'false' }}">
                    <i class="fa-solid fa-shirt"></i>
                    <span class="align-middle">Products</span>
                </a>

                <ul id="forms" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('admin.products.*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                        <a class="sidebar-link"
                        href="{{ route('admin.products.index') }}">
                            Products
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.products.categories.index') ? 'active' : '' }}">
                        <a class="sidebar-link"
                        href="{{ route('admin.products.categories.index') }}">
                            Categories
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.products.brands.index') ? 'active' : '' }}">
                        <a class="sidebar-link"
                        href="{{ route('admin.products.brands.index') }}">
                            Brands
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>