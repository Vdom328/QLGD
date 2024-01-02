@extends('layouts.app')

@section('template_linked_css')
@endsection

@section('page_icon')
<img src="{{ asset('assets/images/icons/list_todo.jpg') }}">
@endsection

@section('page_title')
    Cài đặt môn học
@endsection
@section('title-page')
    Cài đặt môn học
@endsection

@section('page_title_actions')
    <div><i class="fas fa-angle-right"></i> Cài đặt môn học <i class="fas fa-angle-right"></i> Thêm mới</div>
@endsection

@section('content')
    <form method="post" action="{{ route('subject.saveCreate') }}"
        class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
        @csrf
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-8 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="name">Tên môn học</label>
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
                    <label class="form-check-label me-2" for="on-off-switch" data-on="0" data-off="1">Còn hiệu lực / Vô hiệu hóa</label>
                    <div class="form-check form-switch mt-1">
                        <input class="form-check-input  cursor-pointer" type="checkbox" checked id="on-off-switch"
                            name="status" value="{{ Config::get('const.status.yes') }}">
                    </div>
                    <label class="form-check-label me-2 d-none" id="checkbox-on">Còn hiệu lực</label>
                    <label class="form-check-label me-2 d-none" id="checkbox-off">Vô hiệu hóa</label>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-6 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="credits_no">Mã môn học</label>
                    <div class="col-md-12 col-12 flex-wrap d-flex align-items-center">
                        <div class="col-md-8 col-12">
                            <input type="text" class="form-control" id="credits_no" placeholder="" name="credits_no"
                                value="{{ old('credits_no') }}">
                        </div>
                        <div class="col-md-3 col-12 ps-2 pt-2 pt-md-0">
                            <div id="auto-gen" class="btn-grey btn_staff_no cursor-pointer">Tự động</div>
                        </div>
                    </div>
                </div>
                <div class=" d-flex flex-wrap align-items-center ">
                    <p class="w-100 error">{{ $errors->first('credits_no') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-12">
                {{-- status --}}
                <label for="">Là tiết học đầu tiên</label>
                <div class="d-flex align-items-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="avoid_first_lesson" id="avoid_first_lesson1" value="{{ Config::get('const.status.yes') }}">
                        <label class="form-check-label" for="avoid_first_lesson1">Đúng</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" checked type="radio" name="avoid_first_lesson" id="avoid_first_lesson2" value="{{ Config::get('const.status.no') }}">
                        <label class="form-check-label" for="avoid_first_lesson2">Sai</label>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-6 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="block">Số tiết tối thiểu bắt buộc liên tiếp</label>
                    <div class="col-md-12 col-12 d-flex align-items-center">
                        <div class="col-md-8 col-12">
                            <input type="number" class="form-control" id="block" placeholder="" name="block"
                                value="{{ old('block') }}">
                        </div>
                    </div>
                </div>
                <div class=" d-flex flex-wrap align-items-center ">
                    <p class="w-100 error">{{ $errors->first('block') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-12">
                {{-- status --}}
                {{-- <label for="">Tránh việc 2 ngày liên tiếp cùng học</label>
                <div class="d-flex align-items-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="require_spacing" id="require_spacing1" value="{{ Config::get('const.status.yes') }}">
                        <label class="form-check-label" for="require_spacing1">Đúng</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input"checked type="radio" name="require_spacing" id="require_spacing2" value="{{ Config::get('const.status.no') }}">
                        <label class="form-check-label" for="require_spacing2">Sai</label>
                      </div>
                </div> --}}
            </div>
        </div>
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-6 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="quantity_credits">Số tín chỉ</label>
                    <div class="col-md-12 col-12 d-flex align-items-center">
                        <div class="col-md-8 col-12">
                            <input type="number" class="form-control" id="quantity_credits" placeholder="" name="quantity_credits"
                                value="{{ old('quantity_credits') }}">
                        </div>
                    </div>
                </div>
                <div class=" d-flex flex-wrap align-items-center ">
                    <p class="w-100 error">{{ $errors->first('quantity_credits') }}</p>
                </div>
            </div>
            <div class="col-md-6 col-12">
                {{-- status --}}
                <label for="">Là môn học cần phòng chỉ định</label>
                <div class="d-flex align-items-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="require_class_room" id="require_class_room1" value="{{ Config::get('const.status.yes') }}">
                        <label class="form-check-label" for="require_class_room1">Đúng</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input"checked type="radio" name="require_class_room" id="require_class_room2" value="{{ Config::get('const.status.no') }}">
                        <label class="form-check-label" for="require_class_room2">Sai</label>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex mt-4">
            <div class="col-6 text-end ps-2">
                <a href="{{ route('subject.index') }}" type="button" class="btn-dark-dark">Trở lại</a>
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

            // click load staff_no
            $(document).on("click", "#auto-gen", function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('subject.radomNo') }}",
                    data: {},
                    success: function(data) {
                        $('input[name="credits_no"]').val(data.credits_no);
                    },
                });
            });
        });
    </script>
@endsection
