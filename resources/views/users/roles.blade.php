@extends('layouts.master')
@section('title')
    قائمة الاذونات
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
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الاذونات</span>
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
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">عرض جميع الاذونات</h4>
                        <div>
                            <a href="{{ route('roles.create') }}" class='btn btn-outline-primary btn-inline'>اضافة
                                اذن جديد</a>
                        </div>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">قائمة بجميع الاذونات لدينا..</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-20p border-bottom-0">الاذن</th>
                                    <th class="wd-15p border-bottom-0">تاريخ الستجيل</th>
                                    <th class="wd-25p border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>
                                            @if ($role->name != 'owner')
                                                <div class="dropdown">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-primary" data-toggle="dropdown"
                                                        id="dropdownMenuButton" type="button">عمليات <i
                                                            class="fas fa-caret-down ml-1"></i></button>
                                                    <div class="dropdown-menu tx-13">
                                                        <a class="dropdown-item"
                                                            href="{{ route('roles.edit', $role->id) }}">
                                                            تعديل علي البيانات</a>
                                                        <a class="dropdown-item modal-effect forcedel" href="#delete"
                                                            data-effect="effect-scale" data-toggle="modal"
                                                            data-id="{{ $role->id }}"
                                                            data-name="{{ $role->name }}">حذف
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
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
    </div>
    <!-- row closed -->
    <!-- Modal effects -->
    <div class="modal" id="delete">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{ route('roles.destroy', 'Error') }}" method="POST" class="modal-content modal-content-demo">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h6 class="modal-title">حذف هذا الاذن</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" class="hidden_input">
                    <input type="text" name="name" class="form-controller name" disabled>
                    <h6>هل تريد حذف هذا الاذن نهائيا؟!!</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                    <button class="btn ripple btn-success" type="submit">حذف</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal effects-->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script>
        // Add ID For Soft Delete
        let links_del = document.getElementsByClassName("del");
        for (let i = 0; i < links_del.length; i++) {
            links_del[i].addEventListener('click', () => {
                document.getElementsByClassName("hidden_input")[0].value = links_del[i].getAttribute("data-id")
                document.getElementsByClassName("name")[0].value = links_del[i].getAttribute("data-name")
            })
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
@endsection
