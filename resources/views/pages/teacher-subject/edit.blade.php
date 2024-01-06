@extends('layouts.app')

@section('template_linked_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: none !important;
        }

        .select2-container--default .select2-selection--multiple {
            border: none !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 33px;
        }

        .selection {
            display: block;
            width: 100%;
            padding: 0.075rem 2.25rem 0.375rem 0.75rem;
            -moz-padding-start: calc(.75rem - 3px);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .select2-container {
            width: 90% !important;
        }
    </style>
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
    <div class="col-12 d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-12 ">
            <div><i class="fas fa-angle-right"></i> Giảng viên chỉ định <i class="fas fa-angle-right"></i> Chỉnh sửa</div>
        </div>
    </div>
@endsection

@section('content')
    <div method="post" action="{{ route('teacherSubject.create') }}"
        class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
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
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="name">Tiết học ưu tiên</label>
                    <form action="{{ route('teacherSubject.createTimeSlots') }}" method="post" class="col-md-12 col-12 d-flex align-items-center">
                        @csrf
                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        <select class="js-example-basic-multiple-limit" name="time_slots[]" multiple="multiple">

                            @for ($i = 1; $i <= time_slots(); $i++)
                                <option value="{{ $i }}"v @if (isset($teacher_time_slots) && $teacher_time_slots->where('time_slot', $i)->count() >= 1) selected @endif>Tiết {{ $i }}</option>
                            @endfor
                        </select>
                        <button id="btn_filter" type="submit" class="btn-dark-dark ms-2">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12 d-flex flex-wrap">
            <div class="col-12">
                {{-- name class room --}}
                <div class="d-flex flex-wrap align-items-center mb-2">
                    <label for="name">Chú ý*</label>
                    <div class="col-md-12 col-12 d-flex align-items-center">
                        <textarea name="" id="" rows="3" class="form-control" disabled>
Tiết ưu tiên của mỗi giảng viên sẽ được ghi nhận, trong trường học tiết giảng viên đăng kí trùng với nhiều giảng viên khác thì sẽ lấy giảng viên đăng kí thời gian sớm nhất, và giảng viên đăng kí sau sẽ đẩy xuống tiết tiếp theo !
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th data-column="staff_no" data-direction="desc" class="sort_table">Mã môn học
                            <i class="ms-1 fas fa-sort icon_sort"></i>
                        </th>
                        <th data-column="name" data-direction="desc" class="sort_table">Tên môn học
                            <i class="ms-1 fas fa-sort icon_sort"></i>
                        </th>
                        <th>Lớp</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="list_data">
                    @include('pages.teacher-subject.partials._list-subject')
                </tbody>
            </table>
        </div>
        <div class="col-12 d-flex flex-wrap align-items-center">
            <div class="d-flex col-12  mt-md-0 mt-2  justify-content-end">
                <a class="btn-grey btn-modal cursor-pointer" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Thêm
                    môn học cho
                    giảng viên</a>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    @include('pages.teacher-subject.partials._modal')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @include('modals.modal-ajax-delete')
    @include('scripts.ajax-modal-delete-script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-modal', function(e) {
                $('input[name="class"]').prop('checked', false);
            })
            $(".js-example-basic-multiple-limit").select2({});
            //
            $(document).on('click', '.tr_table', function() {
                let id = $(this).attr('data_id');
                $('#' + id).prop('checked', true);
            });

            // create subject
            $(document).on('click', '#create_subject', function(e) {
                let selectedSubjects = [];

                // Lặp qua tất cả các checkbox
                $('input[name="class"]:checked').each(function() {
                    selectedSubjects.push($(this)
                        .val()); // Thêm giá trị của checkbox đã chọn vào mảng
                });
                $.ajax({
                    type: 'post',
                    data: {
                        selectedSubjects: selectedSubjects,
                        teacher_id: {{ $teacher->id }}
                    },
                    url: "{{ route('teacherSubject.createSubject') }}",
                    success: function(response) {
                        if (response.length != 0) {
                            $('#list_data').html(response.resultContainer);
                            $('#staticBackdrop').modal('hide');
                        }
                    },
                });
            });

            $(document).on('change', '.change_class', function() {
                $.ajax({
                    type: 'post',
                    data: {
                        id: $(this).attr('data-id'),
                        class: $(this).val()
                    },
                    url: "{{ route('teacherSubject.create') }}",
                    success: function(response) {
                        console.log(response);
                    },
                });
            });
        });
    </script>
@endsection
