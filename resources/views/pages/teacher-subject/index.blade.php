@extends('layouts.app')

@section('template_linked_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border: none !important;;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }
        .selection {
            display: block;
            width: 100%;
            padding: 0.375rem 2.25rem 0.375rem 0.75rem;
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
    <img src="{{ asset('assets/images/icons/list_todo.jpg') }}">
@endsection

@section('page_title')
    Môn học chỉ định
@endsection
@section('title-page')
    Môn học chỉ định
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-12 ">
            <i class="fas fa-angle-right"></i> Môn học chỉ định
        </div>
    </div>
@endsection

@section('content')
    <div>
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
            <div class="col-12 border_bottom_search pb-2 fw-bold">Chú thích:</div>
            <div class="col-12 pb-2">
                <textarea rows="5" class="form-control" disabled>Là những môn học có phòng học cần chỉ định.
Ví dụ: Môn tin đại cương cần phong labs dùng có máy tính,
          Môn hóa cần phong labs dùng có dụng cụ thí nghiệm,...

                </textarea>
            </div>
            <div class="col-12 border_bottom_search pb-2 fw-bold">Tìm kiếm theo:</div>
            {{--  --}}
            <div class=" row mt-md-3 col-12 d-flex flex-wrap align-items-center">
                <div class="row col-lg-4 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-4 col-md-6 col-12 ">Trạng thái:</div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <select class="form-select" name="status" id="status">
                            <option value=""></option>
                            <option value="{{ Config::get('const.status.yes') }}">Có hiệu lực</option>
                            <option value="{{ Config::get('const.status.no') }}">Vô hiệu hóa</option>
                        </select>
                    </div>
                </div>
                <div class="row col-lg-4 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-lg-5 col-md-6 col-12 text-xl-end">Từ khóa: </div>
                    <div class="col-lg-7 col-md-6 col-12">
                        <input type="text" class="form-control" name="key">
                    </div>
                </div>
                <div class=" col-lg-4 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap justify-content-end">
                    <button id="btn_filter" type="button" class="btn-dark-dark">Tìm kiếm</button>
                </div>
            </div>

            {{--  --}}
        </div>

        <div class="mt-3">
            {{-- <div class="col-12 d-flex justify-content-end mb-2">
                <input type="checkbox" name="filter_me" id="filter_me" class="me-2 cursor-pointer form-check-input"><label
                    for="filter_me" class="cursor-pointer">Chỉ hiển thị những môn học chưa có phòng labs</label>
            </div> --}}
            <div>

            </div>
            <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th data-column="name" data-direction="desc" class="sort_table">Tên môn học
                                <i class="ms-1 fas fa-sort icon_sort"></i>
                            </th>
                            <th data-column="credits_no" data-direction="desc" class="sort_table">Mã môn học
                                <i class="ms-1 fas fa-sort icon_sort"></i>
                            </th>
                            <th data-column="status" data-direction="desc" class="sort_table">Trạng thái
                                <i class="ms-1 fas fa-sort icon_sort"></i>
                            </th>
                            <th>Phòng học</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody id="list_subjects">
                        @include('pages.labs.partials._list')
                    </tbody>
                </table>
            </div>
            <div id="paginate">
                {{ $data->links('pagination::custom') }}
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-room').select2();
            /**
             * click fillter and sort data
             */
            let url = window.location.href;
            let column = 'id';
            let direction = 'asc';
            // form filter
            $('#btn_filter').on('click', function() {
                ajaxdata(url, column, direction)
            });

            // checkbox filter
            $('#filter_me').on('change', function() {
                ajaxdata(url, column, direction)
            });

            //  sort column
            $(document).on('click', '.sort_table', function() {
                column = $(this).attr('data-column');
                direction = $(this).attr('data-direction');
                updateIcon($(this), column, direction);
                ajaxdata(url, column, direction);
            });

            // pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                ajaxdata(url, column, direction)
            });

            // call data
            function ajaxdata(url, column, direction) {
                var isChecked = $("#filter_me").prop("checked");
                $.ajax({
                    type: 'get',
                    data: {
                        filter_me: isChecked,
                        column: column,
                        direction: direction,
                        status: $('select[name="status"]').val(),
                        key: $('input[name="key"]').val(),
                    },
                    url: url,
                    success: function(response) {
                        if (response.length != 0) {
                            $('#list_subjects').html(response.resultContainer);
                            $('#paginate').html(response.paginate);
                            $('.select-room').select2();
                        }
                    },
                });
            }

            // update icon
            function updateIcon(elemen, column, direction) {
                var icon = elemen.find(".fas");
                $('.icon_sort').removeClass('fa-sort-down fa-sort-up').addClass('fa-sort')
                if (direction == 'asc') {
                    elemen.attr('data-direction', 'desc');
                    icon.removeClass('fa-sort').addClass('fa-sort-down');
                } else {
                    elemen.attr('data-direction', 'asc');
                    icon.removeClass('fa-sort').addClass('fa-sort-up');
                }
            }

            $(document).on('change', '.select-room', function() {
                let subject_id = $(this).attr('subject-id');
                let column = 'class_room_id';
                let value = $(this).val();
                ajaxUpdateLabs(subject_id,column,value)
            });

            $(document).on('change', '.description', function() {
                let subject_id = $(this).attr('subject-id');
                let column = 'description';
                let value = $(this).val();
                ajaxUpdateLabs(subject_id,column,value)
            });
            // call update labs data
            function ajaxUpdateLabs(subject_id,column,value) {
                $.ajax({
                    type: 'post',
                    data: {
                        subject_id: subject_id,
                        column: column,
                        value: value
                    },
                    url:"{{ route('labs.create') }}",
                    success: function(response) {
                        console.log(response);
                    },
                });
            }
        });
    </script>
@endsection
