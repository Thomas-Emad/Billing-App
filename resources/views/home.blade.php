@extends('layouts.master')
@section('title')
    الصفحة الرئيسية
@endsection
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا بعودتك مجددا!..</h2>
                <p class="mg-b-0">ماذا تريد ان تفعل الان؟..</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <div>
                <label class="tx-13">عدد المستخدمين</label>
                <h4 class="tx-16">{{ \App\Models\User::count() }}</h4>
            </div>
            <div>
                <label class="tx-13">التاريخ</label>
                <h4 class="tx-16">{{ date('Y/m/d') }}</h4>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">اجمالي الفاوتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">${{ \App\Models\Invoices::sum('total') }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">عدد:{{ \App\Models\Invoices::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">{{ $static_line_all }}</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الفاوتير غير مدغوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    ${{ \App\Models\Invoices::where('val_status', 2)->sum('total') }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                    عدد:{{ \App\Models\Invoices::where('val_status', 2)->count() }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                    %
                                    {{ round((\App\Models\Invoices::where('val_status', 2)->count() / (\App\Models\Invoices::count() == 0 ? 1 : \App\Models\Invoices::count())) * 100) }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">{{ $static_line_unpaid }}</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الفاوتير المدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                        ${{ \App\Models\Invoices::where('val_status', 1)->sum('total') }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">
                                        عدد:{{ \App\Models\Invoices::where('val_status', 1)->count() }}</p>
                                </div>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                    %
                                    {{ round((\App\Models\Invoices::where('val_status', 1)->count() / (\App\Models\Invoices::count() == 0 ? 1 : \App\Models\Invoices::count())) * 100) }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">{{ $static_line_paid }}</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">المدفوعة جزئيا</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                        ${{ \App\Models\Invoices::where('val_status', 3)->sum('total') }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">
                                        عدد:{{ \App\Models\Invoices::where('val_status', 3)->count() }}</p>
                                </div>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                    %
                                    {{ round((\App\Models\Invoices::where('val_status', 3)->count() / (\App\Models\Invoices::count() == 0 ? 1 : \App\Models\Invoices::count())) * 100) }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">{{ $static_line_partpaid }}</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-6 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">الفاوتير</h3>
                    <p class="tx-12 mb-0 text-muted">هنا ملخص سريع بجميع الفاوتير الذي تم اضافتها</p>
                </div>
                <div class="product-timeline card-body pt-2 mt-1">
                    <ul class="timeline-1 mb-0">
                        @foreach ($invoices as $item)
                            <li class="mt-0"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i>
                                <span class="font-weight-semibold mb-4 tx-14"><a
                                        href="{{ url('invoiceDateils', $item->id) }}">{{ $item->product }}</a></span> <a
                                    class="float-left tx-11 text-muted">{{ $item->created_at }}</a>
                                <p class="mb-0 text-muted tx-12">{{ $item->section->section_name }}</p>
                            </li>
                        @endforeach
                        @if (empty($invoices))
                            <p class="text-center text-muted">عذرا, لا يوجد اي مستجددات هنا..</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12 col-lg-6">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center pb-2">
                                <p class="mb-0">عدد الفاوتير المدفوعة</p>
                            </div>
                            <h4 class="font-weight-bold mb-2">{{ \App\Models\Invoices::where('val_status', 1)->count() }}
                            </h4>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-success-gradient"
                                    style="width: {{ round((\App\Models\Invoices::where('val_status', 1)->count() / (\App\Models\Invoices::count() == 0 ? 1 : \App\Models\Invoices::count())) * 100) }}%"
                                    role="progressbar">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="d-flex align-items-center pb-2">
                                <p class="mb-0">عدد الفاوتير المدفوعة جزئيا</p>
                            </div>
                            <h4 class="font-weight-bold mb-2">{{ \App\Models\Invoices::where('val_status', 3)->count() }}
                            </h4>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-primary-gradient"
                                    style="width: {{ round((\App\Models\Invoices::where('val_status', 3)->count() / (\App\Models\Invoices::count() == 0 ? 1 : \App\Models\Invoices::count())) * 100) }}%"
                                    role="progressbar"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="d-flex align-items-center pb-2">
                                <p class="mb-0">عدد الفاوتير غير المدفوعة</p>
                            </div>
                            <h4 class="font-weight-bold mb-2">{{ \App\Models\Invoices::where('val_status', 2)->count() }}
                            </h4>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-danger-gradient"
                                    style="width: {{ round((\App\Models\Invoices::where('val_status', 2)->count() / (\App\Models\Invoices::count() == 0 ? 1 : \App\Models\Invoices::count())) * 100) }}%"
                                    role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
