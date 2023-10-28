@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
@endsection
@section('title')
    المنتجات
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">قائمة المنتجات</h4>
                        <div class="col-sm-6 col-md-3">
                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign"
                                data-toggle="modal" href="#add_item">اضافة منتج</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">اسم المنتج</th>
                                    <th class="wd-20p border-bottom-0">القسم</th>
                                    <th class="wd-15p border-bottom-0">الملاحظات</th>
                                    <th class="wd-10p border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->section->section_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-success btn-inline edit_item"
                                                data-effect="effect-sign" data-toggle="modal" href="#edit_item"
                                                data-id='{{ $item->id }}'
                                                data-item_description='{{ $item->description }}'
                                                data-item_name='{{ $item->item_name }}''>
                                                <i class="icon-settings"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger btn-inline del_item"
                                                data-effect="effect-sign" data-toggle="modal" href="#del_item"
                                                data-id='{{ $item->id }}' data-item_name='{{ $item->item_name }}'>
                                                <i class="icon-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- Modal effects => Add New Item -->
    <div class="modal" id="add_item">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{ route('items.store') }}" method="POST" class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة منتج جديد..</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="mb-4">
                        <p>اسم المنتج</p>
                        <input class="form-control form-control-md" name="item_name" placeholder="اسم المنتج.."
                            type="text" required>

                        <p class="mg-t-20">الاقسام</p>
                        <select name="section_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                            required>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>

                        <p class="mg-t-20">لديك ملاحظات؟</p>
                        <textarea name="description" class="form-control" placeholder="ملاحظات.." rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-success" type="submit">اضافة</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal effects => Edit In Item -->
    <div class="modal" id="edit_item">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/items/update" method="POST" class="modal-content modal-content-demo">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="modal-header">
                    <h6 class="modal-title">تعديل علي منتج ..</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <p>اسم المنتج</p>
                        <input type="hidden" name="id" class="edit_id">
                        <input class="form-control form-control-md edit_name" name="item_name" placeholder="اسم المنتج.."
                            type="text" required>

                        <p class="mg-t-20">الاقسام</p>
                        <input type="text" class="form-control edit_select" disabled>

                        <p class="mg-t-20">لديك ملاحظات؟</p>
                        <textarea name="description" class="form-control edit_description" placeholder="ملاحظات.." rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-success" type="submit">حفظ</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal effects => Delete Item -->
    <div class="modal" id="del_item">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/items/destroy" method="POST" class="modal-content modal-content-demo">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="modal-header">
                    <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <p>هل تريد حذف هذا المنتج؟</p>
                        <input class="del_id" type="hidden" name="id">
                        <input class="form-control form-control-md del_name" placeholder="اسم المنتج.." type="text"
                            disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-success" data-dismiss="modal" type="button">الغاء</button>
                    <button class="btn ripple btn-danger" type="submit">حذف</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal effects-->
    <!-- main-content closed -->
@endsection
@section('js')
    <script>
        // Add Data In Edit Section
        let edit_item_model = document.getElementsByClassName("edit_item");
        for (let i = 0; i < edit_item_model.length; i++) {
            edit_item_model[i].addEventListener("click", () => {
                document.getElementsByClassName("edit_name")[0].value = edit_item_model[i].dataset.item_name;
                document.getElementsByClassName("edit_description")[0].value = edit_item_model[i].dataset
                    .item_description
                document.getElementsByClassName("edit_id")[0].value = edit_item_model[i].dataset
                    .id
            });
        }

        // Delete Section
        let del_item = document.getElementsByClassName("del_item");
        for (let i = 0; i < del_item.length; i++) {
            del_item[i].addEventListener("click", () => {
                document.getElementsByClassName("del_name")[0].value = del_item[i].dataset.item_name;
                document.getElementsByClassName("del_id")[0].value = del_item[i].dataset.id
            });
        }
    </script>
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
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
@endsection
