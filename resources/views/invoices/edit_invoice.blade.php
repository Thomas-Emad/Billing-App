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
                    <form method="POST" action="{{ route('invoices.update', $invoice->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="invoice_number">رقم الفاتورة</label>
                                <input type="text" name="invoice_number" value="{{ $invoice->invoice_number }}"
                                    class="form-control" id="invoice_number" placeholder="ادخل رقم الفاتورة.."
                                    value="{{ old('invoice_number') }}" autocomplete="no" required>
                            </div>
                            <div class="col-4">
                                <label for="date_invoice">تاريخ الفاتورة</label>
                                <div class="row">
                                    <div class="input-group col-12">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input name="date_invoice" id="date_invoice"
                                            class="form-control fc-datepicker" value="{{ $invoice->date_invoice }}"
                                            placeholder="MM/DD/YYYY" type="text" required
                                            value="{{ old('date_invoice') }}" autocomplete="no">
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
                                        </div><input name="pay_invoice" id='pay_invoice'
                                            value="{{ $invoice->pay_invoice }}" class="form-control fc-datepicker"
                                            placeholder="MM/DD/YYYY" type="text" required
                                            value="{{ old('pay_invoice') }}" autocomplete="no">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="section">القسم</label>
                                <select name="section_id" class="form-control select2-no-search" id="section" required>
                                    <option label="الاقسام">
                                    </option>
                                    <option value="{{ $invoice->section_id }}" selected>
                                        {{ $invoice->section->section_name }}</option>
                                    @foreach ($sections as $section)
                                        @if ($section->id != $invoice->section_id)
                                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="product">المنتجه</label>
                                <select name="product" id="product" class="form-control select2-no-search" required>
                                    <option label="المنتجات">
                                    </option>
                                    <option value="{{ $invoice->product }}" selected>
                                        {{ $invoice->product }}
                                    </option>
                                    @foreach ($items as $item)
                                        @if ($item->item_name != $invoice->product)
                                            <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="value_get">مبلغ التحصيل</label>
                                <input type="number" name="value_get" class="form-control value_get" id="value_get"
                                    placeholder="مبلغ المحصل عليه.." value="{{ $invoice->value_get }}" required
                                    value="{{ old('value_get') }}" autocomplete="no">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="value_work">مبلغ العمولة</label>
                                <input type="number" class="form-control value_work" id="value_work" name="value_work"
                                    placeholder="قيمة العمولة الخاص بك.." value="{{ $invoice->value_work }}" required
                                    value="{{ old('value_work') }}" autocomplete="no">
                            </div>
                            <div class="col-4">
                                <label for="discount">قيمة الخصم</label>
                                <input type="number" min="0" value="0" name="discount"
                                    class="form-control discount" id="discount" placeholder="قيمة الخصومات.." required
                                    value="{{ $invoice->pay_invoice }}" value="{{ old('pay_invoice') }}"
                                    autocomplete="no">
                            </div>
                            <div class="col-4">
                                <label for="rate_vat">نسبة ضريبة القيمة المضافة</label>
                                <select name="rate_vat" id='rate_vat' class="form-control select2-no-search rate_vat"
                                    onchange="calcValues()" required>
                                    <option label="اختر النسبة الضريبة">
                                    </option>
                                    <option value="{{ $invoice->rate_vat }}" selected>
                                        {{ $invoice->rate_vat * 100 . '%' }}
                                    </option>
                                    <option value="0.05">5%</option>
                                    <option value="0.1">10%</option>
                                    <option value="0.15">15%</option>
                                    <option value="0.25">25%</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="value_get_vat">قيمة ضريبة القيمة المضافة</label>
                                <input name="value_get_vat" type="number" class="form-control value_get_vat"
                                    id="value_get_vat" placeholder="قيمة ضريبة القيمة المضافة"
                                    value="{{ $invoice->value_get_vat }}" readonly required>
                            </div>
                            <div class="col-6">
                                <label for="total">الاجمالي شامل الضريبة</label>
                                <input name="total" type="number" class="form-control total" id="total"
                                    placeholder="الاجمالي شامل الضريبة" value="{{ $invoice->total }}" required readonly>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <label for="note">الملاحظات</label>
                                <textarea name="note" class="form-control" placeholder="هل لديك ملاحظات خاصا؟.." id="note" rows="3"
                                    value="{{ $invoice->note }}" value="{{ old('note') }}" autocomplete="no"></textarea>
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
    <script>
        // Get Items Section's
        $(document).ready(function() {
            $("select[name='section_id']").on("change", function() {
                let section_id = $(this).val();
                if (section_id) {
                    $.ajax({
                        url: "/section/" + section_id,
                        type: 'GET',
                        dataType: "json",
                        success: function(response) {
                            $("select[name='product']").empty();
                            $.each(response, function(key, value) {
                                $("select[name='product']").append(
                                    " <option value = '" + key + "'>" + key +
                                    " </option>");
                            })
                        }
                    });
                } else {
                    console.log("Error For Ajax")
                }
            })
        })

        // Get Your Vats numbers
        function calcValues() {
            let value_work = parseFloat(document.getElementsByClassName("value_work")[0].value);
            let discount = parseFloat(document.getElementsByClassName("discount")[0].value);
            let rate_vat = parseFloat(document.getElementsByClassName("rate_vat")[0].value);
            let value_af_dis = value_work - discount;
            if (typeof value_work === "undefined" || !value_work) {
                alert("أكتب قيمة مبلغ العمولة..");
            } else {
                let num_af_dis = value_af_dis * rate_vat;
                document.getElementsByClassName("value_get_vat")[0].value = num_af_dis.toFixed(2);

                let total_get_af_vat = num_af_dis + value_af_dis;
                document.getElementsByClassName("total")[0].value = total_get_af_vat.toFixed(2);
            }
        }
    </script>

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
