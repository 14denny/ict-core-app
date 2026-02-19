<!DOCTYPE html>
<html lang="id">
<!--begin::Head-->

<head>
    <base href="" />
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta charset="utf-8" />
    <meta name="description" content="Sistem Informasi Budidaya Bawang Merah" />
    <meta name="keywords" content="budidaya, bawang merah" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ config('app.name') }}" />
    <link rel="shortcut icon" href="{{ url('assets/media/logos/logo-unsyiah-sm.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="{{ url('assets/fonts/inter.css') }}" type="text/css" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ url('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ url('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        .fit-td {
            width: 1%;
            white-space: nowrap;
        }
    </style>
    @hasSection('css')
        @yield('css')
    @endif
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header" data-kt-sticky="true"
                data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky"
                data-kt-sticky-offset="{default: false, lg: '300px'}">
                <!--begin::Header container-->
                <div class="app-container container-fluid d-flex flex-stack" id="kt_app_header_container">
                    <!--begin::Sidebar toggle-->
                    <div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2"
                            id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-outline ki-abstract-14 fs-2"></i>
                        </div>
                        <!--begin::Logo image-->
                        <a href="index.html">
                            <img alt="Logo" src="assets/media/logos/default-small.svg"
                                class="h-30px theme-light-show" />
                            <img alt="Logo" src="assets/media/logos/default-small-dark.svg"
                                class="h-30px theme-dark-show" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Sidebar toggle-->
                    <!--begin::Header wrapper-->
                    <div class="d-flex flex-stack flex-lg-row-fluid" id="kt_app_header_wrapper">
                        <!--begin::Page title-->
                        <div class="page-title gap-4 me-3 mb-5 mb-lg-0" data-kt-swapper="1"
                            data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_wrapper'}">
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 mb-2">
                                @yield('breadcrumbs')
                            </ul>
                            <!--end::Breadcrumb-->
                            <!--begin::Title-->
                            <h1 class="text-gray-900 fw-bolder m-0">@yield('title')</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->
                        {{-- <!--begin::Action-->
                        <a href="#" class="btn btn-primary d-flex flex-center h-35px h-lg-40px"
                            data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">Create
                            <span class="d-none d-sm-inline ps-2">New</span></a>
                        <!--end::Action--> --}}
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->
            <!--begin::Sidebar-->
            <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
                data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                <!--begin::Header-->
                <div class="app-sidebar-header d-none d-lg-flex px-6 pt-8 pb-4" id="kt_app_sidebar_header">
                    <!--begin::App Logo-->
                    <a href="{{ route('beranda.index') }}" data-kt-element="selected"
                        class="btn btn-outline btn-custom btn-flex w-100" data-kt-menu-placement="bottom-start"
                        data-kt-menu-offset="0px, -1px">
                        <!--begin::Logo-->
                        <span class="d-flex flex-center flex-shrink-0 w-40px me-3">
                            <img alt="Logo" src="{{ url('assets/media/logos/logo-unsyiah-sm.png') }}"
                                data-kt-element="logo" class="h-30px" />
                        </span>
                        <!--end::Logo-->
                        <!--begin::Info-->
                        <span class="d-flex flex-column align-items-start flex-grow-1">
                            <span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">{{ config('app.name') }}</span>
                        </span>
                        <!--end::Info-->
                    </a>
                    <!--end::App Logo-->
                </div>
                <!--end::Header-->
                <!--begin::Navs-->
                <div class="app-sidebar-navs flex-column-fluid mx-2 py-6" id="kt_app_sidebar_navs">
                    <div id="kt_app_sidebar_navs_wrappers" class="hover-scroll-y my-2" data-kt-scroll="true"
                        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                        data-kt-scroll-dependencies="#kt_app_sidebar_header, #kt_app_sidebar_footer"
                        data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
                        <!--begin::Sidebar menu-->
                        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
                            class="menu menu-column menu-rounded menu-sub-indention menu-active-bg">
                            <!--begin:Menu item-->
                            @php
                                $parents = session('menus') ? session('menus')['parent'] : [];
                                $subs = session('menus') ? session('menus')['sub'] : [];
                            @endphp
                            @foreach ($parents as $p)
                                @php
                                    $parentActive = MenuHelper::parentActive($p['parent_path']);
                                @endphp
                                <!--begin:Menu item-->
                                <div {!! !$p['url'] ? 'data-kt-menu-trigger="click"' : '' !!}
                                    class="menu-item menu-accordion {{ $parentActive ? 'here show' : '' }}">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ $p['url'] ? url($p['url']) : '#' }}">
                                        <span class="menu-icon">
                                            {!! $p['icon'] !!}
                                        </span>
                                        <span class="menu-title">{{ $p['name'] }}</span>
                                        {!! !$p['url'] ? '<span class="menu-arrow"></span>' : '' !!}
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->
                                    <div class="menu-sub menu-sub-accordion">
                                        @if (isset($subs[$p['name']]))
                                            @foreach ($subs[$p['name']] as $s)
                                                @php
                                                    $submenuActive = MenuHelper::submenuActive($s['url']);
                                                @endphp
                                                <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link {{ $submenuActive ? 'active' : '' }}"
                                                        href="{{ url($s['url']) }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ $s['name'] }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            @endforeach
                                        @endif
                                    </div>
                                    <!--end:Menu sub-->
                                </div>
                                <!--end:Menu item-->
                            @endforeach
                            <!--end:Menu item-->
                        </div>
                        <!--end::Sidebar menu-->
                    </div>
                </div>
                <!--end::Navs-->
                <!--begin::Footer-->
                <div class="app-sidebar-footer d-flex flex-stack px-11 pb-10" id="kt_app_sidebar_footer">
                    <!--begin::User menu-->
                    <div class="">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-circle symbol-40px"
                            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true"
                            data-kt-menu-placement="top-start">
                            <img src="assets/media/avatars/300-2.jpg" alt="image" />
                        </div>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo" src="assets/media/avatars/300-2.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bold d-flex align-items-center fs-5">Alice Page
                                            <span
                                                class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                                        </div>
                                        <a href="#"
                                            class="fw-semibold text-muted text-hover-primary fs-7">alice@kt.com</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--begin::Menu item-->
                            <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                <a href="#" class="menu-link px-5">
                                    <span class="menu-title position-relative">Mode
                                        <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                            <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                                            <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                                        </span></span>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                    data-kt-menu="true" data-kt-element="theme-mode-menu">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="light">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-outline ki-night-day fs-2"></i>
                                            </span>
                                            <span class="menu-title">Light</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="dark">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-outline ki-moon fs-2"></i>
                                            </span>
                                            <span class="menu-title">Dark</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="system">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-outline ki-screen fs-2"></i>
                                            </span>
                                            <span class="menu-title">System</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Menu item-->
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{ route('auth.logout') }}" class="menu-link px-5">Sign
                                    Out</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::User account menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::User menu-->
                    <!--begin::Logout-->
                    <a href="{{ route('auth.logout') }}" class="btn btn-sm btn-outline btn-flex btn-custom px-3">
                        <i class="ki-outline ki-entrance-left fs-2 me-2"></i>Logout</a>
                    <!--end::Logout-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Sidebar-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-column-fluid">
                    <!--begin::Container-->
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-fluid">
                            @yield('body')
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2024&copy;</span>
                            <a href="https://ict.usk.ac.id/" target="_blank"
                                class="text-gray-800 text-hover-primary">ICT USK</a>
                        </div>
                        <!--end::Copyright-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->
    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ url('assets/') }}";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('assets/js/custom-datatable.js') }}"></script>
    <script src="{{ url('assets/js/swal.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->

    <script>
        var csrf_token = "{{ csrf_token() }}"
    </script>
    @if (Session::has('status'))
        <script>
            showSwal("{{ Session::get('status') }}", "{!! Session::get('msg') !!}")
        </script>
    @endif

    @hasSection('js')
        @yield('js')
    @endif
</body>
<!--end::Body-->

</html>
