@extends('layouts.app')

@section('template_linked_css')
    <style>
        .noti-email {
            padding: 10px;
            border: 1px solid;
            border-radius: 9px;
        }
    </style>
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/th.png') }}" />
@endsection

@section('page_title')
    Cài đặt lớp học
@endsection
@section('title-page')
    Cài đặt lớp học
@endsection

@section('page_title_actions')
    <div><i class="fas fa-angle-right"></i> Cài đặt lớp học <i class="fas fa-angle-right"></i> Thêm mới</div>
@endsection

@section('content')
    <form method="post" action="{{ route('class.postRegister') }}"
        class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
        @csrf
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-8 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="name">Tên lớp</label>
                    <div class="col-md-12 col-12 d-flex align-items-center">
                        <div class="col-md-6 col-12">
                            <input type="text" class="form-control" id="name" placeholder="" name="name"
                                value="{{ old('name') }}">
                        </div>
                    </div>
                </div>
                <div class=" d-flex flex-wrap align-items-center ">
                    <p class="w-100 error">{{ $errors->first('name') }}</p>
                </div>
            </div>
            <div class="col-md-4 col-12">
                {{-- status --}}
                <div class="d-flex flex-wrap align-items-center mb-3 mt-md-4">
                    <label class="form-check-label me-2" for="on-off-switch" data-on="0" data-off="1">Đóng / Mở</label>
                    <div class="form-check form-switch mt-1">
                        <input class="form-check-input  cursor-pointer" type="checkbox" checked id="on-off-switch"
                            name="status" value="{{ Config::get('const.status.yes') }}">
                    </div>
                    <label class="form-check-label me-2 d-none" id="checkbox-on">Mở</label>
                    <label class="form-check-label me-2 d-none" id="checkbox-off">Đóng</label>
                </div>
            </div>
        </div>
        <div class="col-12">
            <label for="description">Ghi chú</label>
            <textarea class="form-control" placeholder="" id="description" rows="5" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="col-12 d-flex mt-4">
            <div class="col-6 text-end ps-2">
                <a href="{{ route('class.index') }}" type="button" class="btn-dark-dark">Trở lại</a>
            </div>
            <div class="col-6 ps-2">
                <button type="submit" class="btn-dark-dark">Gửi</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            var $checkbox = $('#on-off-switch');
            var $labelOn = $('#checkbox-on');
            var $labelOff = $('#checkbox-off');

            $checkbox.change(function() {
                if ($checkbox.prop('checked')) {
                    $labelOn.removeClass('d-none');
                    $labelOff.addClass('d-none');
                } else {
                    $labelOn.addClass('d-none');
                    $labelOff.removeClass('d-none');
                }
            });

            if ($checkbox.prop('checked')) {
                $labelOn.removeClass('d-none');
                $labelOff.addClass('d-none');
            } else {
                $labelOn.addClass('d-none');
                $labelOff.removeClass('d-none');
            }
        });
    </script>
@endsection
