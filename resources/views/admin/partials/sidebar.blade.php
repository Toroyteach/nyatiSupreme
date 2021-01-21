<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.orders.index' ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="app-menu__icon fa fa-object-group"></i>
                <span class="app-menu__label">Orders</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="app-menu__icon fa fa-shopping-bag"></i>
                <span class="app-menu__label">Products</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Categories</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.attributes.index' ? 'active' : '' }}" href="{{ route('admin.attributes.index') }}">
                <i class="app-menu__icon fa fa-th"></i>
                <span class="app-menu__label">Attributes</span>
            </a>
        </li>

        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">Users</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="{{ route('customers.index') }}"><i class="icon fa fa-circle-o"></i> Customers</a>
                </li>
                <li>
                    <a class="treeview-item" href="{{ route('users.index') }}"><i class="icon fa fa-circle-o"></i> Users</a>
                </li>
                <li>
                    <a class="treeview-item" href="{{ route('roles.index') }}"><i class="icon fa fa-circle-o"></i> Roles</a>
                </li>
                <li>
                    <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Permissions</a>
                </li>
            </ul>
        </li>
        
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.notification' ? 'active' : '' }}" href="{{ route('admin.notification') }}">
                <i class="app-menu__icon fa fa-flag-o"></i>
                <span class="app-menu__label">Notifications</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.feedback' ? 'active' : '' }}" href="{{ route('admin.feedback') }}">
                <i class="app-menu__icon fa fa-comments-o"></i>
                <span class="app-menu__label">Customer Feedback</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.productrequest' ? 'active' : '' }}" href="{{ route('admin.productrequest') }}">
                <i class="app-menu__icon fa fa-product-hunt"></i>
                <span class="app-menu__label">Product Request</span>
            </a>
        </li>
    </ul>
</aside>
