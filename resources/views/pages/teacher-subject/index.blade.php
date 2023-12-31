@extends('layouts.app')

@section('template_linked_css')

@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/truck.png') }}">
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
            <i class="fas fa-angle-right"></i> Giảng viên chỉ định
        </div>
    </div>
@endsection

@section('content')
    <div>
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
            <div class="col-12 border_bottom_search pb-2 fw-bold">Chú thích:</div>
            <div class="col-12 pb-2">
                <textarea rows="5" class="form-control" disabled>Là những những giảng viên được chỉ định dậy môn nào.
Ví dụ: Giảng viên A được chỉ định dậy những môn như môn1, môn2 ,...
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
                            <option value="{{ Config::get('const.status.no') }}">Có hiệu lực</option>
                            <option value="{{ Config::get('const.status.yes') }}">Vô hiệu hóa</option>
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
            <div>

            </div>
            <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th  data-column="staff_no" data-direction="desc" class="sort_table">Số Nhân Viên
                                <i class="ms-1 fas fa-sort icon_sort"></i>
                            </th>
                            <th></th>
                            <th data-column="name" data-direction="desc" class="sort_table">Tên giảng viên
                                <i class="ms-1 fas fa-sort icon_sort"></i>
                            </th>
                            <th data-column="email" data-direction="desc" class="sort_table">Email
                                <i class="ms-1 fas fa-sort icon_sort"></i>
                            </th>
                            <th>Môn học</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list_data">
                        @include('pages.teacher-subject.partials._list')
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
    <script>
        $(document).ready(function() {
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
                $.ajax({
                    type: 'get',
                    data: {
                        column: column,
                        direction: direction,
                        status: $('select[name="status"]').val(),
                        key: $('input[name="key"]').val(),
                    },
                    url: url,
                    success: function(response) {
                        if (response.length != 0) {
                            $('#list_data').html(response.resultContainer);
                            $('#paginate').html(response.paginate);
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
