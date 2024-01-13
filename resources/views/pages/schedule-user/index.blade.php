@php
    use App\Classes\Enum\RoleUserEnum;
@endphp
@extends('layouts.app')

@section('template_linked_css')
    <style>
        .table {
            font-size: 13px;
        }

        .table td {
            padding: 0px;
            min-width: 100px !important;
        }
    </style>
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/calculator.png') }}">
@endsection

@section('page_title')
    Thời khóa biểu người dùng
@endsection
@section('title-page')
    Thời khóa biểu người dùng
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-12 ">
            <i class="fas fa-angle-right"></i> Thời khóa biểu người dùng
        </div>
    </div>
@endsection

@section('content')
    <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
        <textarea name="" id="" class="form-control" rows="4" disabled>Chú ý *:
    Mầu đỏ tượng trưng cho thời khóa biểu ngày hôm đó bị trùng môn trong cùng 1 tiết học
    Nếu có hãy đăng kí lại môn học của Sinh viên</textarea>
    </div>

    <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm mt-4" >
        <div class="col-12 border_bottom_search pb-2 fw-bold">Tìm kiếm theo:</div>
        {{--  --}}
        <div class=" row mt-md-3 col-12 d-flex flex-wrap align-items-center">
            <div class=" col-lg-6 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                Tên:
                <div class="col-lg-7 col-md-6 col-12 ps-2">
                    <select class="form-select" name="user_filter" id="user_filter">
                        <option value=""></option>
                        @foreach ($list_user as $item_user )
                            @if ($item_user->level() == RoleUserEnum::ADMIN->value)
                                @continue
                            @endif
                            <option value="{{ $item_user->id }}">
                                @if ($item_user->level() == RoleUserEnum::STUDENT->value)
                                    SV:
                                @else
                                    GV:
                                @endif
                                {{  $item_user->profile->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class=" col-lg-6 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap justify-content-end">
                <button id="btn_filter" type="button" class="btn-dark-dark">Tìm kiếm</button>
            </div>
        </div>
        {{--  --}}
    </div>

    <div  class="mt-4">
        <div class="col-12 mt-3 d-flex flex-wrap align-items-center">
            <button type="button" data-bs-toggle="tooltip" id="exportButton" title="Xuất CSV" data-bs-placement="bottom"
                class="btn-shadow ms-3 btn btn-primary btn-add-new export-csv">
                <i class="fa-solid fa-file-export"></i>
                Xuất CSV
            </button>
        </div>
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm mt-3">
            <div class="container" id="list_data">
                @include('pages.schedule-user.partials._table')
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <!-- Sử dụng CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
            // xuất excel
            $(document).on('click', '#exportButton', function() {
                const table = document.getElementById('myTable');
                const wb = XLSX.utils.table_to_book(table, {
                    sheet: 'SheetJS'
                });
                XLSX.writeFile(wb, 'schedule.xlsx');
            })

            $(document).on('click', '#btn_filter', function() {
                $.ajax({
                    type: 'get',
                    data: {
                        user_id: $('#user_filter').val(),
                    },
                    url: window.location.href,
                    success: function(response) {
                        if (response.length != 0) {
                            $('#list_data').html(response.resultContainer);
                        }
                    },
                });
            })

        });
    </script>
@endsection
