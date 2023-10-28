@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
@endsection
@section('title')
    الاقسام
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الاقسام</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0 fs-2">قائمة الاقسام</h4>
                        <a class="modal-effect btn btn-outline-primary btn-inline" data-effect="effect-sign"
                            data-toggle="modal" href="#add_section">اضافة قسم</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم القسم</th>
                                    <th>ملاحظات</th>
                                    <th>عمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($sections as $item)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $item->section_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-success btn-inline edit_section"
                                                data-effect="effect-sign" data-toggle="modal" href="#edit_section"
                                                data-id='{{ $item->id }}' data-section_name='{{ $item->section_name }}'
                                                data-section_description='{{ $item->description }}'>
                                                <i class="icon-settings"></i></a>
                                            <a class="modal-effect btn btn-danger btn-inline del_section"
                                                data-effect="effect-sign" data-toggle="modal" href="#del_section"
                                                data-id='{{ $item->id }}' data-section_name='{{ $item->section_name }}'>
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
    </div>

    {{-- Model --}}
    <div class="modal" id="add_section">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <form action="{{ route('sections.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title">اضافة قسم جديد..</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input name="section_name" class="form-control mb-2" placeholder="اسم القسم" type="text">
                        <textarea name="description" class="form-control" placeholder="الملاحظات" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                        <button class="btn ripple btn-outline-success" type="submit">اضافة..</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- row closed -->
    </div>
    <div class="modal" id="edit_section">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/sections/update" method="POST" class="modal-content modal-content-demo">
                {{ method_field('Patch') }}
                {{ csrf_field() }}
                <div class="modal-header">
                    <h6 class="modal-title">تعديل معلومات القسم..</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input name="id" class="form-control mb-2 edit_id" type="hidden">
                    <input name="section_name" class="form-control mb-2 edit_title" placeholder="اسم القسم" type="text">
                    <textarea name="description" class="form-control edit_descrition" placeholder="الملاحظات" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                    <button class="btn ripple btn-outline-success" type="submit">تعديل..</button>
                </div>
            </form>
        </div>
        <!-- row closed -->
    </div>
    <div class="modal" id="del_section">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/sections/destroy" method="POST" class="modal-content modal-content-demo">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <strong class="mb-2">هل تريد حذف هذا القسم؟..</strong>
                    <input name="id" type="hidden" class="del_id">
                    <input name="section_name" class="form-control mb-2 del_section_name" placeholder="اسم القسم"
                        type="text" disabled>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                    <button class="btn ripple btn-outline-danger" type="submit">حذف</button>
                </div>
            </form>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>

    <script>
        // Add Data In Edit Section
        let edit_section = document.getElementsByClassName("edit_section");
        for (let i = 0; i < edit_section.length; i++) {
            edit_section[i].addEventListener('click', (event) => {
                document.getElementsByClassName("edit_title")[0].value = edit_section[i].dataset.section_name
                document.getElementsByClassName("edit_descrition")[0].value = edit_section[i].dataset
                    .section_description
                document.getElementsByClassName("edit_id")[0].value = edit_section[i].dataset
                    .id
            })
        }

        // Delete Section
        let del_section = document.getElementsByClassName("del_section");
        for (let i = 0; i < del_section.length; i++) {
            del_section[i].addEventListener('click', () => {
                document.getElementsByClassName("del_id")[0].value = del_section[i].dataset
                    .id
                document.getElementsByClassName("del_section_name")[0].value = del_section[i].dataset
                    .section_name
            })
        }
    </script>
@endsection
