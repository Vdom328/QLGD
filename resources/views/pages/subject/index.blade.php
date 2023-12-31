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
    <div class="col-12 d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-12 ">
            <i class="fas fa-angle-right"></i> Cài đặt môn học
        </div>
        <div class="d-flex col-md-6 col-12  mt-md-0 mt-2  justify-content-end">
            @include('components.btn-create-new', ['url' => route('subject.create')])
        </div>
    </div>
@endsection

@section('content')
    <div>
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
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
            <div class="col-12 d-flex justify-content-end mb-2">
                <input type="checkbox" name="filter_me" id="filter_me" class="me-2 cursor-pointer form-check-input"><label
                    for="filter_me" class="cursor-pointer">Chỉ hiển thị những môn học là tiết học đầu tiên</label>
            </div>
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
                            <th data-column="quantity_credits" data-direction="desc" class="sort_table">Số tín chỉ
                                <i class="ms-1 fas fa-sort icon_sort"></i>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list_subjects">
                        @include('pages.subject.partials._list')
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
@include('modals.modal-ajax-delete')
@include('scripts.ajax-modal-delete-script')
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
        });
    </script>
@endsection
