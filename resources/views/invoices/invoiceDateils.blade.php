@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    معلومات عن الفاتورة
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معلومات
                    الفاتورة ({{ $invoice->invoice_number }})</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row p-3" style="background-color: #fff;">
        <div class="panel panel-primary tabs-style-2 w-100">
            <div class=" tab-menu-heading">
                <div class="tabs-menu1 row justfiy-space-between">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs main-nav-line">
                        <li><a href="#tab1" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
                        <li><a href="#tab2" class="nav-link" data-toggle="tab">حالات الفاتورة</a></li>
                        <li><a href="#tab3" class="nav-link" data-toggle="tab">المرفقات</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body main-content-body-right border">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>رقم الفاتورة</th>
                                                <th>تاريخ الفاتورة</th>
                                                <th>تاريخ الاستحقاق</th>
                                                <th>المنتجه</th>
                                                <th>القسم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ $invoice->invoice_number }}</th>
                                                <td>{{ $invoice->date_invoice }}</td>
                                                <td>{{ $invoice->pay_invoice }}</td>
                                                <td>{{ $invoice->product }}</td>
                                                <td>{{ $invoice->section->section_name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>مبلغ التحصيل</th>
                                                <th>مبلغ العمولة</th>
                                                <th>قيمة الخصم</th>
                                                <th>نسبة ضريبة القيمة المضافة </th>
                                                <th>قيمة ضريبة القيمة المضافة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ $invoice->value_get }}</th>
                                                <td>{{ $invoice->value_work }}</td>
                                                <td>{{ $invoice->discount }}</td>
                                                <td>{{ $invoice->rate_vat * 100 . '%' }}</td>
                                                <td>{{ $invoice->value_get_vat }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>الاجمالي شامل الضريبة</th>
                                                <th>الملاحظات</th>
                                                <th>حالة الفاتورة</th>
                                                <th>موظف ادخال</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ $invoice->total }}</th>
                                                <td>{{ $invoice->note }}</td>
                                                <td>
                                                    @if ($invoice->val_status == 1)
                                                        <span class="btn btn-sm btn-success">{{ $invoice->status }}</span>
                                                    @elseif ($invoice->val_status == 2)
                                                        <span class="btn btn-sm btn-danger">{{ $invoice->status }}</span>
                                                    @else
                                                        <span class="btn btn-sm btn-warning">{{ $invoice->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $invoice->user }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div><!-- bd -->
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>المنتج</th>
                                                <th>الحالة</th>
                                                <th>الملاحظات</th>
                                                <th>التاريخ</th>
                                                <th>موظف تعديل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($invoice_details as $detail)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>{{ $detail->product }}</td>
                                                    <td>
                                                        @if ($detail->val_status == 1)
                                                            <span class='text-success'>{{ $detail->status }}</span>
                                                        @elseif ($detail->val_status == 2)
                                                            <span class='text-danger'>{{ $detail->status }}</span>
                                                        @else
                                                            <span class='text-warning'>{{ $detail->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $detail->note }}</td>
                                                    <td>{{ $detail->created_at }}</td>
                                                    <td>{{ $detail->user }}</td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div><!-- bd -->
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form action="{{ route('attch.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                            <input type="hidden" name="invoice_number"
                                                value="{{ $invoice->invoice_number }}">
                                            <label for="formFile" class="form-label text-danger">* غير مسموح برفع ملفات غير
                                                بهذا الصيغ (.pdf, .png, .jpg, .jpeg)</label>
                                            <input class="form-control" name="file" type="file" id="formFile">
                                        </div>
                                        <button class="btn btn-sm btn-primary m-2 btn-block" type="submit">اضافة</button>
                                    </form>
                                    <hr>
                                    <table class="table table-hover mb-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الملف</th>
                                                <th>المستخدم</th>
                                                <th>الوقت</th>
                                                <th>عمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($invoice_attchments as $attchment)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>{{ $attchment->name_file }}</td>
                                                    <td>{{ $attchment->user_add }}</td>
                                                    <td>{{ $attchment->created_at }}</td>
                                                    <td>
                                                        <a href="{{ url('invoiceDateils/show/' . $invoice->invoice_number . '/' . $attchment->name_file) }}"
                                                            class='btn btn-info' target="__blank">مشاهدة</a>
                                                        <a href="{{ url('invoiceDateils/download/' . $invoice->invoice_number . '/' . $attchment->name_file) }}"
                                                            class='btn btn-success'>تحميل</a>
                                                        <a href="{{ url('invoiceDateils/delete/' . $attchment->id) }}"
                                                            class='btn btn-danger'>حذف</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if ($i == 1)
                                        <p class='text-center mt-2'>عذا, لايوجد اي مرفقات هنا..</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>


    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
@endsection
