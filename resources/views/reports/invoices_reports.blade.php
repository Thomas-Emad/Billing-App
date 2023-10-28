@extends('layouts.master')
@section('title')
    تقرير الفاوتير
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تقرير الفاوتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('invoicesSearch') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="rdiobox"><input name="type_search" type="radio" value="1" checked
                                        @checked(($type_search ?? 0) == 1)>
                                    <span>بحث
                                        بنوع الفاتورة</span></label>
                            </div>
                            <div class="col-lg-3">
                                <label class="rdiobox"><input name="type_search" type="radio" value="2"
                                        @checked(($type_search ?? 0) == 2)> <span>بحث
                                        برقم الفاتورة</span></label>
                            </div>
                        </div>
                        <div class="row number">
                            <div class="col-4">
                                <label for="number_invoice">رقم القاتورة</label>
                                <input name="number_invoice" class="form-control" placeholder="يرجا ادخال رقم القاتورة.."
                                    type="text" autocomplete="no" value="{{ $invoice_number ?? '' }}">
                            </div>
                        </div>
                        <div class="row type">
                            <div class="col-4">
                                <label for="type_invoice">الفاوتير</label>
                                <select name="type_invoice" class="form-control select2-no-search" id="type_invoice">
                                    <option value="" selected>الكل</option>
                                    <option value="1" @selected(($type_invoice ?? 0) == 1)>الفاتورة المدفوعة</option>
                                    <option value="2" @selected(($type_invoice ?? 0) == 2)>الفاتورة غير المدفوعة</option>
                                    <option value="3" @selected(($type_invoice ?? 0) == 3)>الفاتورة المدفوعة جزئيا</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="start_at">من تاريخ</label>
                                <div class="row">
                                    <div class="input-group col-12">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input name="start_at" id="start_at" class="form-control fc-datepicker"
                                            placeholder="MM/DD/YYYY" type="text" autocomplete="no"
                                            value="{{ $start_at ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="end_at">الي تاريخ</label>
                                <div class="row">
                                    <div class="input-group col-12">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input name="end_at" class="form-control fc-datepicker"
                                            placeholder="MM/DD/YYYY" type="text" autocomplete="no"
                                            value="{{ $end_at ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inline mt-2" type="submit">بحث</button>
                    </form>
                    @if (isset($invoices))
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">رقم الفاتورة</th>
                                        <th class="wd-20p border-bottom-0">تاريخ الفاتورة</th>
                                        <th class="wd-15p border-bottom-0">تاريخ الاستحقاق</th>
                                        <th class="wd-20p border-bottom-0">المنتجه</th>
                                        <th class="wd-20p border-bottom-0">القسم</th>
                                        <th class="wd-15p border-bottom-0">قيمتة الخصم</th>
                                        <th class="wd-15p border-bottom-0">نسبة الضريبة %</th>
                                        <th class="wd-15p border-bottom-0">قيمتة الضريبة</th>
                                        <th class="wd-15p border-bottom-0">الاجمالي</th>
                                        <th class="wd-10p border-bottom-0">الحالة</th>
                                        <th class="wd-25p border-bottom-0">ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <a href="invoiceDateils/{{ $invoice->id }}" target="_blank"
                                                    rel="noopener noreferrer">{{ $invoice->invoice_number }}</a>
                                            </td>
                                            <td>{{ $invoice->date_invoice }}</td>
                                            <td>{{ $invoice->pay_invoice }}</td>
                                            <td>{{ $invoice->product }}</td>
                                            <td>{{ $invoice->section->section_name }}</td>
                                            <td>{{ $invoice->discount }}</td>
                                            <td>{{ $invoice->rate_vat * 100 . '%' }}</td>
                                            <td>{{ $invoice->value_get_vat }}</td>
                                            <td>{{ $invoice->total }}</td>
                                            <td>
                                                @if ($invoice->val_status == 1)
                                                    <span class='text-success'>{{ $invoice->status }}</span>
                                                @elseif ($invoice->val_status == 2)
                                                    <span class='text-danger'>{{ $invoice->status }}</span>
                                                @else
                                                    <span class='text-warning'>{{ $invoice->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $invoice->note }}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
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
        $(document).ready(function() {
            $(".number").hide();
            $("input[name='type_search']").on("click", function() {
                let type_search = $(this).val();
                if (type_search == 1) {
                    $(".number").hide();
                    $(".type").show();
                } else {
                    $(".type").hide();
                    $(".number").show();
                }
            })
        })
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
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
@endsection
