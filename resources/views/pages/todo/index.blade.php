@extends('layouts.app')

@section('template_linked_css')
    <style>
        .active {
            background: #0553e1 !important;
            color: white;
        }

        tbody tr td:first-child {
            min-width: 80px;
        }

        .icon_arrou_table {
            background: #2b7af1;
            color: white;
            border-radius: 50%;
            font-size: 12px;
            padding: 2px 2px 1px;
        }

        .button-status:hover {
            background: #0553e1 !important;
            color: white;
            transform: scale(1.1);
        }
    </style>
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/list_todo.jpg') }}">
@endsection

@section('page_title')
    ToDo一覧
@endsection
@section('title-page')
    ToDo一覧
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-12 ">
            > ToDo一覧
        </div>
        <div class="d-flex col-md-6 col-12  mt-md-0 mt-2  justify-content-end">
            @include('components.btn-create-new', ['url' => route('todo.register')])
        </div>
    </div>
@endsection

@section('content')
    <div>
        <form class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm" id="form_search">
            <div class="col-12 border_bottom_search pb-2">絞り込み</div>
            <div class="row mt-3 col-12 d-flex flex-wrap align-items-center">
                <div class="col-lg-7 col-12 d-flex align-items-center flex-wrap">
                    <div class="col-lg-1 col-12 text-lg-end">狀態:</div>
                    <div class="col-lg-11 col-12 group-status ps-3">
                        @foreach ($statusValues as $status)
                            <button data-value="{{ $status['value'] }}"
                                class="me-2 custom_button mt-md-0 mt-2 button-status" type="button"
                                name="{{ $status['value'] }}">
                                {{ $status['name'] }}
                            </button>
                        @endforeach
                        <button type="button" class="me-2 custom_button mt-md-0 mt-2 active button-status"
                            name="not_cancel">完了以外</button>
                    </div>
                </div>
                <div class="col-lg-5 col-12 d-flex flex-wrap align-items-center mt-lg-0 mt-2">
                    <div class="col-md-3 col-12 text-md-end text-nowrap">フリーワード:</div>
                    <div class="col-md-9 col-12 ps-2">
                        <input type="text" class="form-control" name="key" value="">
                    </div>
                </div>
            </div>
            <div class=" row mt-md-3 col-12 d-flex flex-wrap align-items-center">
                <div class="col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-md-3 col-12 text-md-end pe-2">担当者:</div>
                    <div class="col-md-9 col-12">
                        <select class="form-select" name="manager_todo">
                            <option value=""></option>
                            @foreach ($users as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->profile->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-md-3 col-12 text-md-end pe-2">登錄者:</div>
                    <div class="col-md-9 col-12">
                        <select class="form-select" name="registrar_todo">
                            <option value=""></option>
                            @foreach ($users as $registrar)
                                <option value="{{ $registrar->id }}">{{ $registrar->profile->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                    <div class="col-md-3 col-12 text-md-end pe-2">取引先: </div>
                    <div class="col-md-9 col-12">
                        <select class="form-select" disabled>

                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap justify-content-end">
                    <button id="btn_filter" type="button" class="btn-dark-dark">検　索</button>
                </div>
            </div>
        </form>

        <div class="mt-3">
            <div class="col-12 d-flex justify-content-end mb-2">
                <input type="checkbox" name="filter_me" id="filter_me" class="me-2 cursor-pointer form-check-input"><label
                    for="filter_me" class="cursor-pointer">自分が担当のものだけ表示</label>
            </div>
            <div>

            </div>
            <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th></th>
                            <th data-column="expired_date" data-direction="desc" class="sort_table">期限日<i
                                    class="ms-1 fas fa-sort icon_sort"></i></th>
                            <th>內容</th>
                            <th data-column="title" data-direction="desc" class="sort_table">タイトル<i
                                    class="ms-1 fas fa-sort icon_sort"></i></th>
                            <th data-column="name_project" data-direction="desc" class="sort_table">案件名<i
                                    class="ms-1 fas fa-sort icon_sort"></i></th>
                            <th>取引先名</th>
                            <th data-column="created_at" data-direction="desc" class="sort_table">登录日<i
                                    class="ms-1 fas fa-sort icon_sort"></i></th>
                            <th data-column="updated_at" data-direction="desc" class="sort_table">更新日<i
                                    class="ms-1 fas fa-sort icon_sort"></i></th>
                            <th>担当</th>
                            <th>依賴者</th>
                        </tr>
                    </thead>
                    <tbody id="list_todo">
                        @include('pages.todo.partials._list', compact('todo'))
                    </tbody>
                </table>
                <div id="paginate">
                    {{ $todo->links('pagination::custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            /* Click status, add or remove class action in this button status */
            $('.button-status').click(function() {
                $(this).toggleClass('active');
            })
            var buttons = $('button[name="5"], button[name="not_cancel"]');
            buttons.click(function() {
                if ($(this).hasClass('active')) {
                    buttons.removeClass('active');
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });

            /**
             * click fillter and sort data
             */
            let url = "{{ route('todo.index') }}";
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

                let activeValues = [];
                $('.button-status').each(function() {
                    if ($(this).hasClass('active')) {
                        activeValues.push($(this).attr('data-value'));
                    }
                });

                $.ajax({
                    type: 'get',
                    data: {
                        filter_me: isChecked,
                        column: column,
                        direction: direction,
                        manager_id: $('select[name="manager_todo"]').val(),
                        registrar_id: $('select[name="registrar_todo"]').val(),
                        status: activeValues,
                        not_cancel: $('button[name="not_cancel"]').hasClass('active'),
                        key: $('input[name="key"]').val(),
                    },
                    url: url,
                    success: function(response) {
                        if (response.length != 0) {
                            $('#list_todo').html(response.resultContainer);
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
        })
    </script>
@endsection
