<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LARAVEL E-COMM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">

                @can('Access Dashboard')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endcan
                
                {{-- User Roles & Management --}}
                @if(auth()->user()->hasRole('Super Admin|Admin'))
                
                    {{-- Roles --}}
                    @can('View Roles')
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    @endcan

                    {{-- Permissions --}}
                    @can('View Permissions')
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link {{ request()->is('admin/permissions*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-lock"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    @endcan

                    <!-- Users -->
                    @can('View Users')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>   
                    @endcan

                @endif

                @can('General Features')	
                    <!-- Sections -->
                    <li class="nav-item">
                        <a href="{{ route('sections.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Sections</p>
                        </a>
                    </li>

                    <!-- Category -->
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Category</p>
                        </a>
                    </li>

                    <!-- Sub Category -->
                    <li class="nav-item">
                        <a href="{{ route('subcategories.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>Sub Category</p>
                        </a>
                    </li>

                    <!-- Brands -->
                    <li class="nav-item">
                        <a href="{{ route('brands.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Brands</p>
                        </a>
                    </li>

                    <!-- Products -->
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>Products</p>
                        </a>
                    </li>

                    <!-- Orders -->
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>Orders</p>
                        </a>
                    </li>

                    <!-- Discounts -->
                    <li class="nav-item">
                        <a href="{{ route('coupon.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-percent"></i>
                            <p>Discount</p>
                        </a>
                    </li>

                    <!-- Pages -->
                    <li class="nav-item">
                        <a href="{{ route('pages.index') }}" class="nav-link">
                            <i class="nav-icon far fa-file-alt"></i>
                            <p>Pages</p>
                        </a>
                    </li>

                    {{-- Ratings --}}
                    <li class="nav-item">
                        <a href="{{ route('rating.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-star"></i>
                            <p>Ratings</p>
                        </a>
                    </li>
                @endcan

            </ul>
        </nav>
    </div>
</aside>
