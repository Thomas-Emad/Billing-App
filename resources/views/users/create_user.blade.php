@extends('layouts.master')
@section('title')
    اضافة مستخدم
@endsection
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
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
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                    مستخدم</span>
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
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="name">اسم المستخدم</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="ادخل اسم المستخدم.." value="{{ old('name') }}" autocomplete="no"
                                    required>
                            </div>
                            <div class="col-6">
                                <label for="email">البريد الالكتروني</label>
                                <input type="text" name="email" class="form-control" id="email"
                                    placeholder="ادخل البريد الالكتروني.." value="{{ old('email') }}" autocomplete="no"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="password">كلمة المرور</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="ادخل كلمة المرور.." autocomplete="no" required>
                            </div>
                            <div class="col-6">
                                <label for="confirm-password">تاكيد كلمة المرور</label>
                                <input type="password" name="confirm-password" class="form-control" id="confirm-password"
                                    placeholder="ادخل تاكيد كلمة المرور.." autocomplete="no" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <label for="roles">الاذونات</label>
                                <select class="form-control select2" id="roles" name="roles[]" multiple="multiple">
                                    <option label="الاذونات"></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" style="margin:auto;display: block;" class="btn btn-success btn-block mt-4">
                            اضافة المستخدم</button>
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
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
@endsection
