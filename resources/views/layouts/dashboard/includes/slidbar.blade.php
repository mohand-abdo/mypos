<nav class="navbar navbar-vertical {{ app()->getlocale() =='ar'?'fixed-right':'fixed-left' }} navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
    <a class="navbar-brand pt-0" href="{{route('dashboard.welcome')}}">
            <img src="{{asset('dashboard_files/assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ auth()->user()->image_path }}">
                        </span>
                    </div>
                </a>
                @include('layouts.dashboard.includes.dropdown')
            </li>
        </ul>
        <!-- Collapse -->
        <div class="navbar-collapse collapse" id="sidenav-collapse-main" style="">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="./index.html">
                            <img src="{{asset('dashboard_files/assets/img/brand/blue.png')}}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
            <li class="nav-item" >
                    <a class=" nav-link {{isActive('dashboard.welcome')}} " href="{{route('dashboard.welcome')}}"> <i class="ni ni-tv-2 text-primary"></i> @lang('dashboard.dashboard')</a>
                </li>
                @if (auth()->user()->can('read_categories'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.categories.index')}}" href="{{route('dashboard.categories.index')}}"> <i class="fa fa-layer-group text-blue"></i> @lang('dashboard.categories')</a>
                    </li>
                @endif
                @if (auth()->user()->can('create_categories'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.categories.create')}}" href="{{route('dashboard.categories.create')}}"> <i class="fa fa-clipboard-list text-green"></i> @lang('dashboard.add') @lang('dashboard.category')</a>
                    </li>
                @endif
                 @if (auth()->user()->can('read_products'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.products.index')}}" href="{{route('dashboard.products.index')}}"> <i class="fa fa-layer-group text-brown"></i> @lang('dashboard.products')</a>
                    </li>
                @endif
                @if (auth()->user()->can('create_products'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.products.create')}}" href="{{route('dashboard.products.create')}}"> <i class="fa fa-cart-plus text-info"></i> @lang('dashboard.add') @lang('dashboard.product')</a>
                    </li>
                @endif
                @if (auth()->user()->can('read_clients'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.clients.index')}}" href="{{route('dashboard.clients.index')}}"> <i class="fa fa-user text-red"></i> @lang('dashboard.clients')</a>
                    </li>
                @endif
                @if (auth()->user()->can('create_clients'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.clients.create')}}" href="{{route('dashboard.clients.create')}}"> <i class="fa fa-user-check text-gray"></i> @lang('dashboard.add') @lang('dashboard.client')</a>
                    </li>
                @endif
                @if (auth()->user()->can('read_orders'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.orders.index')}}" href="{{route('dashboard.orders.index')}}"> <i class="fa fa-flag text-orange"></i> @lang('dashboard.orders')</a>
                    </li>
                @endif
                @if (auth()->user()->can('read_users'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.users.index')}}" href="{{route('dashboard.users.index')}}"> <i class="fa fa-users text-pink"></i> @lang('dashboard.users')</a>
                    </li>
                @endif
                @if (auth()->user()->can('create_users'))
                    <li class="nav-item">
                        <a class=" nav-link {{isActive('dashboard.users.create')}}" href="{{route('dashboard.users.create')}}"> <i class="fa fa-user-plus text-yellow"></i> @lang('dashboard.add') @lang('dashboard.user')</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>