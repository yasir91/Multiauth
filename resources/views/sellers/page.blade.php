@extends('seller::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body',
    (config('seller.sidebar_mini', true) === true ?
        'sidebar-mini ' :
        (config('seller.sidebar_mini', true) == 'md' ?
         'sidebar-mini sidebar-mini-md ' : '')
    ) .
    (config('seller.layout_topnav') || View::getSection('layout_topnav') ? 'layout-top-nav ' : '') .
    (config('seller.layout_boxed') ? 'layout-boxed ' : '') .
    (!config('seller.layout_topnav') && !View::getSection('layout_topnav') ?
        (config('seller.layout_fixed_sidebar') ? 'layout-fixed ' : '') .
        (config('seller.layout_fixed_navbar') === true ?
            'layout-navbar-fixed ' :
            (isset(config('seller.layout_fixed_navbar')['xs']) ? (config('seller.layout_fixed_navbar')['xs'] == true ? 'layout-navbar-fixed ' : 'layout-navbar-not-fixed ') : '') .
            (isset(config('seller.layout_fixed_navbar')['sm']) ? (config('seller.layout_fixed_navbar')['sm'] == true ? 'layout-sm-navbar-fixed ' : 'layout-sm-navbar-not-fixed ') : '') .
            (isset(config('seller.layout_fixed_navbar')['md']) ? (config('seller.layout_fixed_navbar')['md'] == true ? 'layout-md-navbar-fixed ' : 'layout-md-navbar-not-fixed ') : '') .
            (isset(config('seller.layout_fixed_navbar')['lg']) ? (config('seller.layout_fixed_navbar')['lg'] == true ? 'layout-lg-navbar-fixed ' : 'layout-lg-navbar-not-fixed ') : '') .
            (isset(config('seller.layout_fixed_navbar')['xl']) ? (config('seller.layout_fixed_navbar')['xl'] == true ? 'layout-xl-navbar-fixed ' : 'layout-xl-navbar-not-fixed ') : '')
        ) .
        (config('seller.layout_fixed_footer') === true ?
            'layout-footer-fixed ' :
            (isset(config('seller.layout_fixed_footer')['xs']) ? (config('seller.layout_fixed_footer')['xs'] == true ? 'layout-footer-fixed ' : 'layout-footer-not-fixed ') : '') .
            (isset(config('seller.layout_fixed_footer')['sm']) ? (config('seller.layout_fixed_footer')['sm'] == true ? 'layout-sm-footer-fixed ' : 'layout-sm-footer-not-fixed ') : '') .
            (isset(config('seller.layout_fixed_footer')['md']) ? (config('seller.layout_fixed_footer')['md'] == true ? 'layout-md-footer-fixed ' : 'layout-md-footer-not-fixed ') : '') .
            (isset(config('seller.layout_fixed_footer')['lg']) ? (config('seller.layout_fixed_footer')['lg'] == true ? 'layout-lg-footer-fixed ' : 'layout-lg-footer-not-fixed ') : '') .
            (isset(config('seller.layout_fixed_footer')['xl']) ? (config('seller.layout_fixed_footer')['xl'] == true ? 'layout-xl-footer-fixed ' : 'layout-xl-footer-not-fixed ') : '')
        )
        : ''
    ) .
    (config('seller.sidebar_collapse') || View::getSection('sidebar_collapse') ? 'sidebar-collapse ' : '') .
    (config('seller.right_sidebar') && config('seller.right_sidebar_push') ? 'control-sidebar-push ' : '') .
    config('seller.classes_body')
)

@section('body_data',
(config('seller.sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light' ? 'data-scrollbar-theme=' . config('seller.sidebar_scrollbar_theme')  : '') . ' ' . (config('seller.sidebar_scrollbar_auto_hide', 'l') != 'l' ? 'data-scrollbar-auto-hide=' . config('seller.sidebar_scrollbar_auto_hide')   : ''))

@php( $adminlte = config('seller', 'adminlte') )
@php( $logout_url = View::getSection('logout_url') ?? config('seller.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('seller.profile_url', 'logout') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('seller.dashboard_url', 'home') )

@if (config('seller.use_route_url', false))
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="wrapper">
        @if(config('seller.layout_topnav') || View::getSection('layout_topnav'))
        <nav class="main-header navbar {{config('seller.classes_topnav_nav', 'navbar-expand-md')}} {{config('seller.classes_topnav', 'navbar-white navbar-light')}}">
            <div class="{{config('seller.classes_topnav_container', 'container')}}">
                @if(config('seller.logo_img_xl'))
                    <a href="{{ $dashboard_url }}" class="navbar-brand logo-switch">
                        <img src="{{ asset(config('seller.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('seller.logo_img_alt', 'AdminLTE')}}" class="{{config('seller.logo_img_class', 'brand-image-xl')}} logo-xs">
                        <img src="{{ asset(config('seller.logo_img_xl')) }}" alt="{{config('seller.logo_img_alt', 'AdminLTE')}}" class="{{config('seller.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                    </a>
                @else
                    <a href="{{ $dashboard_url }}" class="navbar-brand {{ config('seller.classes_brand') }}">
                        <img src="{{ asset(config('seller.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('seller.logo_img_alt', 'AdminLTE')}}" class="{{ config('seller.logo_img_class', 'brand-image img-circle elevation-3') }}" style="opacity: .8">
                        <span class="brand-text font-weight-light {{ config('seller.classes_brand_text') }}">
                            {!! config('seller.logo', '<b>Admin</b>LTE') !!}
                        </span>
                    </a>
                @endif

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="nav navbar-nav">
                        @each('seller::partials.menu-item-top-nav-left', $seller->menu(), 'item')
                    </ul>
                </div>
            @else
            <nav class="main-header navbar {{config('seller.classes_topnav_nav', 'navbar-expand-md')}} {{config('seller.classes_topnav', 'navbar-white navbar-light')}}">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" @if(config('seller.sidebar_collapse_remember')) data-enable-remember="true" @endif @if(!config('seller.sidebar_collapse_remember_no_transition')) data-no-transition-after-reload="false" @endif @if(config('seller.sidebar_collapse_auto_size')) data-auto-collapse-size="{{config('seller.sidebar_collapse_auto_size')}}" @endif>
                            <i class="fas fa-bars"></i>
                            <span class="sr-only">{{ __('seller.toggle_navigation') }}</span>
                        </a>
                    </li>
                    @each('seller::partials.menu-item-top-nav-left' , $seller->menu(), 'item')
                    @yield('content_top_nav_left')
                </ul>
            @endif
                <ul class="navbar-nav ml-auto @if(config('seller.layout_topnav') || View::getSection('layout_topnav'))order-1 order-md-3 navbar-no-expand @endif">
                    @yield('content_top_nav_right')
                    @each('seller::partials.menu-item-top-nav-right', $seller->menu(), 'item')
                    @if(Auth::user())
                        @if(config('seller.usermenu_enabled'))
                        <li class="nav-item dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                @if(config('seller.usermenu_image'))
                                <img src="{{ Auth::user()->adminlte_image() }}" class="user-image img-circle elevation-2" alt="{{ Auth::user()->name }}">
                                @endif
                                <span @if(config('seller.usermenu_image'))class="d-none d-md-inline"@endif>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                @if(!View::hasSection('usermenu_header') && config('seller.usermenu_header'))
                                <li class="user-header {{ config('seller.usermenu_header_class', 'bg-primary') }} @if(!config('seller.usermenu_image'))h-auto @endif">
                                    @if(config('seller.usermenu_image'))
                                    <img src="{{ Auth::user()->adminlte_image() }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                                    @endif
                                    <p class="@if(!config('seller.usermenu_image'))mt-0 @endif">
                                        {{ Auth::user()->name }}
                                        @if(config('seller.usermenu_desc'))
                                        <small>{{ Auth::user()->adminlte_desc() }}</small>
                                        @endif
                                    </p>
                                </li>
                                @else
                                @yield('usermenu_header')
                                @endif
                                @each('seller::partials.menu-item-top-nav-user', $seller->menu(), 'item')
                                @hasSection('usermenu_body')
                                <li class="user-body">
                                    @yield('usermenu_body')
                                </li>
                                @endif
                                <li class="user-footer">
                                    @if($profile_url)
                                    <a href="{{ $profile_url }}" class="btn btn-default btn-flat">Profile</a>
                                    @endif

                                    <a class="btn btn-default btn-flat float-right @if(!$profile_url)btn-block @endif" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-fw fa-power-off"></i> {{ __('seller.log_out') }}
                                    </a>
                                    <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                                        @if(config('seller.logout_method'))
                                            {{ method_field(config('seller.logout_method')) }}
                                        @endif
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-power-off"></i> {{ __('seller.log_out') }}
                            </a>
                            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                                @if(config('seller.logout_method'))
                                    {{ method_field(config('seller.logout_method')) }}
                                @endif
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endif
                    @endif
                    @if(config('seller.right_sidebar'))
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-widget="control-sidebar" @if(!config('seller.right_sidebar_slide')) data-controlsidebar-slide="false" @endif @if(config('seller.right_sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light') data-scrollbar-theme="{{config('seller.right_sidebar_scrollbar_theme')}}" @endif @if(config('seller.right_sidebar_scrollbar_auto_hide', 'l') != 'l') data-scrollbar-auto-hide="{{config('seller.right_sidebar_scrollbar_auto_hide')}}" @endif>
                                <i class="{{config('seller.right_sidebar_icon')}}"></i>
                            </a>
                        </li>
                    @endif
                </ul>
                @if(config('seller.layout_topnav') || View::getSection('layout_topnav'))
                    </nav>
                @endif
            </nav>
        @if(!config('seller.layout_topnav') && !View::getSection('layout_topnav'))
        <aside class="main-sidebar {{config('seller.classes_sidebar', 'sidebar-dark-primary elevation-4')}}">
            @if(config('seller.logo_img_xl'))
                <a href="{{ $dashboard_url }}" class="brand-link logo-switch">
                    <img src="{{ asset(config('seller.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('seller.logo_img_alt', 'AdminLTE')}}" class="{{config('seller.logo_img_class', 'brand-image-xl')}} logo-xs">
                    <img src="{{ asset(config('seller.logo_img_xl')) }}" alt="{{config('seller.logo_img_alt', 'AdminLTE')}}" class="{{config('seller.logo_img_xl_class', 'brand-image-xs')}} logo-xl">
                </a>
            @else
                <a href="{{ $dashboard_url }}" class="brand-link {{ config('seller.classes_brand') }}">
                    <img src="{{ asset(config('seller.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" alt="{{config('seller.logo_img_alt', 'AdminLTE')}}" class="{{ config('seller.logo_img_class', 'brand-image img-circle elevation-3') }}" style="opacity: .8">
                    <span class="brand-text font-weight-light {{ config('seller.classes_brand_text') }}">
                        {!! config('seller.logo', '<b>Admin</b>LTE') !!}
                    </span>
                </a>
            @endif
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column {{config('seller.classes_sidebar_nav', '')}}" data-widget="treeview" role="menu" @if(config('seller.sidebar_nav_animation_speed') != 300) data-animation-speed="{{config('seller.sidebar_nav_animation_speed')}}" @endif @if(!config('seller.sidebar_nav_accordion')) data-accordion="false" @endif>
                        @each('seller::partials.menu-item', $seller->menu(), 'item')
                    </ul>
                </nav>
            </div>
        </aside>
        @endif

        <div class="content-wrapper">
            @if(config('seller.layout_topnav') || View::getSection('layout_topnav'))
            <div class="container">
            @endif

            <div class="content-header">
                <div class="{{config('seller.classes_content_header', 'container-fluid')}}">
                    @yield('content_header')
                </div>
            </div>

            <div class="content">
                <div class="{{config('seller.classes_content', 'container-fluid')}}">
                    @yield('content')
                </div>
            </div>
            @if(config('seller.layout_topnav') || View::getSection('layout_topnav'))
            </div>
            @endif
        </div>

        @hasSection('footer')
        <footer class="main-footer">

            @yield('footer')
        </footer>
        @endif

        @if(config('seller.right_sidebar'))
            <aside class="control-sidebar control-sidebar-{{config('seller.right_sidebar_theme')}}">
                @yield('right-sidebar')
            </aside>
        @endif

    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
