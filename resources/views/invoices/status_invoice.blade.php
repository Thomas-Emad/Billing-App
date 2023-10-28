@extends('layouts.master')
@section('title')
    تعديل فاتورة
@endsection
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
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                    فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-body">
                    <form method="POST" action="{{ url('invoices/statusInvoice/changeStatus') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $invoice->id }}">
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="invoice_number">رقم الفاتورة</label>
                                <input type="text" value="{{ $invoice->invoice_number }}" class="form-control"
                                    id="invoice_number" placeholder="ادخل رقم الفاتورة.." required readonly>
                            </div>
                            <div class="col-4">
                                <label for="date_invoice">تاريخ الفاتورة</label>
                                <div class="row">
                                    <div class="input-group col-12">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input id="date_invoice" class="form-control fc-datepicker"
                                            value="{{ $invoice->date_invoice }}" placeholder="MM/DD/YYYY" type="text"
                                            required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="pay_invoice">تاريخ الاستحقاق</label>
                                <div class="row">
                                    <div class="input-group col-12">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input id='pay_invoice' value="{{ $invoice->pay_invoice }}"
                                            class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text"
                                            required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="section">القسم</label>
                                <input type="text" class="form-control" name="section_id"
                                    value="{{ $invoice->section->section_name }}" required readonly>
                            </div>
                            <div class="col-4">
                                <label for="product">المنتجه</label>
                                <input type="text" class="form-control" name="product" value="{{ $invoice->product }}"
                                    required readonly>
                            </div>
                            <div class="col-4">
                                <label for="value_get">مبلغ التحصيل</label>
                                <input type="number" class="form-control value_get" id="value_get"
                                    placeholder="مبلغ المحصل عليه.." value="{{ $invoice->value_get }}" required readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="value_work">مبلغ العمولة</label>
                                <input type="number" class="form-control value_work" name="value_work"
                                    placeholder="قيمة العمولة الخاص بك.." value="{{ $invoice->value_work }}" required
                                    readonly>
                            </div>
                            <div class="col-4">
                                <label for="discount">قيمة الخصم</label>
                                <input type="number" class="form-control discount" id="discount"
                                    placeholder="قيمة الخصومات.." required value="{{ $invoice->pay_invoice }}"
                                    value="{{ old('pay_invoice') }}" readonly>
                            </div>
                            <div class="col-4">
                                <label for="rate_vat">نسبة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" value="{{ $invoice->rate_vat }}" required
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="value_get_vat">قيمة ضريبة القيمة المضافة</label>
                                <input type="number" class="form-control value_get_vat" id="value_get_vat"
                                    placeholder="قيمة ضريبة القيمة المضافة" value="{{ $invoice->value_get_vat }}"
                                    readonly required>
                            </div>
                            <div class="col-6">
                                <label for="total">الاجمالي شامل الضريبة</label>
                                <input type="number" class="form-control total" id="total"
                                    placeholder="الاجمالي شامل الضريبة" value="{{ $invoice->total }}" required readonly>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <label for="note">الملاحظات</label>
                                <textarea class="form-control" placeholder="هل لديك ملاحظات خاصا؟.." id="note" rows="3"
                                    value="{{ $invoice->note }}" name="note" readonly></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <label for="status">تعديل الحالة</label>
                                <select name="status" class="form-control select2-no-search" id="status" required>
                                    <option label="تعديل الحالة">
                                    </option>
                                    <option value="1" selected>الفاتورة مدفوعة</option>
                                    <option value="2">الفاتورة غير مدفوعة</option>
                                    <option value="3">الفاتورة مدفوعة جزئيا</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="payment_date">تاريخ الدفع</label>
                                <div class="row">
                                    <div class="input-group col-12">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input name="payment_date" id="payment_date"
                                            class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text"
                                            required autocomplete="no">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" style="margin:auto;display: block;"
                            class="btn btn-success btn-block mt-4">تعديل
                            الفاتورة</button>
                    </form>
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
