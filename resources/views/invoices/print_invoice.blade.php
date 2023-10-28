@extends('layouts.master')
@section('title')
    معانية الفاتورة قبل الطباعة
@endsection
@section('css')
    <style>
        @media print {
            .button {
                display: none;
            }
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    معانية الفاتورة قبل الطباعة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm " id="invoice">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">Billing App</h1>
                            <div class="billed-from">
                                <h6>BootstrapDash, Inc.</h6>
                                <p>201 Something St., Something Town, YT 242, Country 6546<br>
                                    Tel No: 324 445-4544<br>
                                    Email: youremail@companyname.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">Billed To</label>
                                <div class="billed-to">
                                    <h6>Juan Dela Cruz</h6>
                                    <p>4033 Patterson Road, Staten Island, NY 10301<br>
                                        Tel No: 324 445-4544<br>
                                        Email: youremail@companyname.com</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">معلومات الفاتورة</label>
                                <p class="invoice-info-row"><span>رقم الفاتورة:</span>
                                    <span>{{ $invoice->invoice_number }}</span>
                                </p>
                                <p class="invoice-info-row"><span>تاريخ الفاتورة:</span>
                                    <span>{{ $invoice->date_invoice }}</span>
                                </p>
                                <p class="invoice-info-row"><span>المنتج:</span> <span>{{ $invoice->product }}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">المنتج</th>
                                        <th class="tx-right">قيمة الفاتورة</th>
                                        <th class="tx-right">العمولة</th>
                                        <th class="tx-right">الاجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $invoice->product }}</td>
                                        <td class="tx-center">{{ $invoice->value_get }}</td>
                                        <td class="tx-right">{{ $invoice->total }}</td>
                                        <td class="tx-right">{{ $invoice->total + $invoice->value_get }}</td>
                                    </tr>
                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                        </td>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ $invoice->total + $invoice->value_get }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                        <button class="btn btn-danger float-left mt-3 mr-2 button">
                            <i class="mdi mdi-printer ml-1" onclick="print_invoice()"></i>طباعة
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
<script>
    function print_invoice() {
        let content = document.getElementById("invoice").innerHTML;
        let body = document.querySelector("html").innerHTML;
        document.querySelector("body").innerHTML = content;
        window.print();
        document.querySelector("body").innerHTML = body;
    }
</script>
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
@endsection
