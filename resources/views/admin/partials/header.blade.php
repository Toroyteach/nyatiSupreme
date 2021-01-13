<header class="app-header">
    <a class="app-header__logo" href="#">{{ config('app.name') }}</a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">
        <li class="app-search" title="Your Cart">
            <input class="app-search__input" type="search" placeholder="Search" />
            <button class="app-search__button">
                <i class="fa fa-search"></i>
            </button>
        </li>
        <li class="dropdown">
            <a class="app-nav__item notif" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg" data-toggle="tooltip" data-placement="top" title="Notifications"></i>
                    <span class="num" style="color:red">{{ $countnotifications }}</span>
                </a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                @if ($countnotifications > 0)
                <li class="app-notification__title">
                    You have {{ $countnotifications }} new notifications.
                </li>
                @endif

                <div class="app-notification__content">

                    @forelse($notifications as $notification)

                    @if ($notification->data['type'] == 'New Order')
                            <!-- new order notification -->
                    <li>
                        <a class="app-notification__item" href="{{ route('admin.orders.show', $notification->data['order_id']) }}">
                            <span class="app-notification__icon">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-warning"></i>
                                    <i class="fa fa-first-order fa-stack-1x fa-inverse"></i>
                                </span>
                            </span>
                            <div>
                                <p class="app-notification__message">
                                    A new order from {{ $notification->data['first_name']}} has been placed.
                                </p>
                                <p class="app-notification__meta">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}} </p>
                            </div>
                        </a>
                    </li>

                    @endif

                    @if ($notification->data['type'] == 'Completed Order')
                            <!-- order status change notification -->
                    <li>
                        <a class="app-notification__item" href="{{ route('admin.orders.show', $notification->data['order_id']) }}">
                            <span class="app-notification__icon">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-check-circle-o fa-stack-1x fa-inverse"></i>
                                </span>
                            </span>
                            <div>
                                <p class="app-notification__message">
                                    Order from {{ $notification->data['first_name']}} with order id {{ $notification->data['order_id']}} is now Complete
                                </p>
                                <p class="app-notification__meta">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}} </p>
                            </div>
                        </a>
                    </li>

                    @endif

                    @if ($notification->data['type'] == 'Low Count')
                            <!-- order status change notification -->
                    <li>
                        <a class="app-notification__item" href="">
                            <span class="app-notification__icon">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-exclamation-triangle fa-stack-1x fa-inverse"></i>
                                </span>
                            </span>
                            <div>
                                <p class="app-notification__message">
                                    The following products have low count {{ $notification->data['low_product']}}
                                </p>
                                <p class="app-notification__meta">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}} </p>
                            </div>
                        </a>
                    </li>

                    @endif


                    @empty
                    <li class="app-notification__title">
                        You have <span>NO<span> new notifications.
                    </li>
                    @endforelse
                    
                </div>
                <li class="app-notification__footer">
                    <a href="{{ route('admin.notification') }}">See all notifications.</a>
                </li>
            </ul>
        </li>
        <!-- User Menu-->
        <!-- <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                <li class="app-notification__title">
                    You have 4 new notifications.
                </li>
                <div class="app-notification__content">
                    <li>
                        <a class="app-notification__item" href="javascript:;">
                            <span class="app-notification__icon">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i>
                                </span>
                            </span>
                            <div>
                                <p class="app-notification__message">
                                    Mail server not working
                                </p>
                                <p class="app-notification__meta">5 min ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="app-notification__item" href="javascript:;">
                            <span class="app-notification__icon">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                                </span>
                            </span>
                            <div>
                                <p class="app-notification__message">
                                    Transaction complete
                                </p>
                                <p class="app-notification__meta">2 days ago</p>
                            </div>
                        </a>
                    </li>
                </div>
                <li class="app-notification__footer">
                    <a href="#">See all notifications.</a>
                </li>
            </ul>
        </li> -->
        <!-- User Menu-->
        <li class="dropdown">
        @if (Auth::user()->profile_image != null)
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><div class="icon" data-toggle="tooltip" data-placement="top" title="View Profile"><img class="icon icon-sm rounded-circle" style="width:20px;height:20px"src="{{ asset('storage/' . Auth::user()->profile_image) }}"></div></a>
        @else
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg" data-toggle="tooltip" data-placement="top" title="View Profile"></i></a>
        @endif
            
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="fa fa-cog fa-lg"></i> Settings</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</header>
