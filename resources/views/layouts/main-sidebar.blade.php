<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . ($page = 'home')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . ($page = 'home')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="main-logo dark-theme"
                alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'home')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'home')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon-white.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ URL::asset('assets/img/faces/6.jpg') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->roles[0]->name }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">الصفحة الرئيسية</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'home')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                    </svg><span class="side-menu__label">الصفحة الرئيسية</span></a>
            </li>
            @can('invoices')
                <li class="side-item side-item-category">الفواتير</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3" />
                            <path
                                d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z" />
                        </svg><span class="side-menu__label">الفواتير</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('invoices_table')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'invoices')) }}">قائمة الفواتير</a></li>
                        @endcan
                        @can('invoices_paid')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'invoicesPaid')) }}">الفواتير المدفوعة</a>
                            </li>
                        @endcan
                        @can('invoices_unpaid')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'invoicesUnpaid')) }}">الفواتير الغير
                                    مدفوعة</a>
                            </li>
                        @endcan
                        @can('invoices_partpaid')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'invoicesPartpaid')) }}">الفواتير المدفوعة
                                    جزائيا</a>
                            @endcan
                            @can('invoices_archive')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'archive')) }}">الارشيف</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('reports')
                <li class="side-item side-item-category">التقارير</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                            <path
                                d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                        </svg><span class="side-menu__label">التقارير</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('reports_invoices')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'invoicesReports')) }}">تقرير الفواتير</a>
                            </li>
                        @endcan
                        @can('reports_customers')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'usersReports')) }}">تقرير العملاء</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('users')
                <li class="side-item side-item-category">المستخدمين</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm3.5 4c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-7 0c.83 0 1.5.67 1.5 1.5S9.33 11 8.5 11 7 10.33 7 9.5 7.67 8 8.5 8zm3.5 9.5c-2.33 0-4.32-1.45-5.12-3.5h1.67c.7 1.19 1.97 2 3.45 2s2.76-.81 3.45-2h1.67c-.8 2.05-2.79 3.5-5.12 3.5z"
                                opacity=".3" />
                            <circle cx="15.5" cy="9.5" r="1.5" />
                            <circle cx="8.5" cy="9.5" r="1.5" />
                            <path
                                d="M12 16c-1.48 0-2.75-.81-3.45-2H6.88c.8 2.05 2.79 3.5 5.12 3.5s4.32-1.45 5.12-3.5h-1.67c-.69 1.19-1.97 2-3.45 2zm-.01-14C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" />
                        </svg><span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('users_table')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'users')) }}">قائمة المستخدمين</a></li>
                        @endcan
                        @can('roles')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'roles')) }}">الاذونات</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('settings')
                <li class="side-item side-item-category">الاعدادات</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z"
                                opacity=".3" />
                            <path
                                d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z" />
                        </svg><span class="side-menu__label">الاعدادات</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('sections')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'sections')) }}">الاقسام</a></li>
                        @endcan
                        @can('product')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'items')) }}">المنتجات</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
