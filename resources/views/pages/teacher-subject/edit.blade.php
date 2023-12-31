@extends('layouts.app')

@section('template_linked_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/truck.png') }}" />
@endsection

@section('page_title')
    Giảng viên chỉ định
@endsection
@section('title-page')
    Giảng viên chỉ định
@endsection

@section('page_title_actions')
    <div><i class="fas fa-angle-right"></i> Giảng viên chỉ định <i class="fas fa-angle-right"></i> Chỉnh sửa</div>
@endsection

@section('content')
    <form method="post" action="{{ route('teacherSubject.create') }}"
        class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
        @csrf
        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-md-6 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="name">Tên giảng viên</label>
                    <div class="col-md-12 col-12 d-flex align-items-center">
                        <div class="col-md-6 col-12">
                            <input type="text" class="form-control" disabled value="{{ $teacher->profile->fullname }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="name">Mã giảng viên</label>
                    <div class="col-md-12 col-12 d-flex align-items-center">
                        <div class="col-md-6 col-12">
                            <input type="text" class="form-control" disabled value="{{ $teacher->profile->staff_no }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <label for="description">Môn học</label>
            <select name="subject_id[]" multiple="multiple" class="form-control js-example-basic-multiple-limit">
                @foreach ($subject as $item)
                    <option value="{{ $item->id }}" {{ collect($teacher_subject)->pluck('subject_id')->contains($item->id) ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 d-flex mt-4">
            <div class="col-6 text-end ps-2">
                <a href="{{ route('teacherSubject.index') }}" type="button" class="btn-dark-dark">Trở lại</a>
            </div>
            <div class="col-6 ps-2">
                <button type="submit" class="btn-dark-dark">Gửi</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".js-example-basic-multiple-limit").select2({
            });
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
