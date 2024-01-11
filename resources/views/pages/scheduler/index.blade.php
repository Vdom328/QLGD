@extends('layouts.app')

@section('template_linked_css')
    <style>
        .table {
            font-size: 10px;
        }

        .table td {
            padding: 3px;
            min-width: 100px !important;
            height: 37px;

        }
    </style>
@endsection

@section('page_icon')
    <img src="{{ asset('assets/images/icons/notes.png') }}">
@endsection

@section('page_title')
    Thời khóa biểu
@endsection
@section('title-page')
    Thời khóa biểu
@endsection

@section('page_title_actions')
    <div class="col-12 d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-12 ">
            <i class="fas fa-angle-right"></i> Thời khóa biểu
        </div>
        <div class="d-flex col-md-6 col-12  mt-md-0 mt-2  justify-content-end">
            <button type="button" id="create_new" class="btn-shadow ms-3 btn btn-primary btn-add-new" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
                <i class="fa fa-add"></i>
                Tạo TKB mới
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm">
        <div class="col-12 border_bottom_search pb-2 fw-bold">Tìm kiếm theo:</div>
        {{--  --}}
        <div class=" row mt-md-3 col-12 d-flex flex-wrap align-items-center">
            <div class=" col-lg-6 col-md-6 col-12 mt-lg-0 mt-2 d-flex flex-wrap align-items-center">
                Tên:
                <div class="col-lg-7 col-md-6 col-12 ps-2">
                    <select class="form-select" name="schedule" id="schedule_id">
                        <option value=""></option>
                        @foreach ($list_schedule as $list_schedule)
                            <option value="{{ $list_schedule->id }}" @if ($schedule['id'] ==  $list_schedule->id)
                                selected
                            @endif>{{ $list_schedule->name }}</option>
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
    <div id="list_data" class="mt-4">

        @include('pages.scheduler.partials._table')
    </div>
@endsection

@section('footer_scripts')
    <!-- Sử dụng CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    @include('pages.scheduler.partials._modal')
    <script>
        $(document).ready(function() {

            // tìm kiếm
            $(document).on('click', '#btn_filter', function() {
                $.ajax({
                    type: 'get',
                    data: {
                        id: $('#schedule_id').val(),
                    },
                    url: window.location.href,
                    success: function(response) {
                        if (response.length != 0) {
                            $('#list_data').html(response.resultContainer);
                        }
                    },
                });
            })

            // xuất excel
            $(document).on('click', '#exportButton', function() {
                const table = document.getElementById('myTable');
                const wb = XLSX.utils.table_to_book(table, { sheet: 'SheetJS' });
                XLSX.writeFile(wb, 'schedule.xlsx');
            })

            // tạo tkb mới
            $(document).on('click', '#create_tbk', function() {
                $.ajax({
                    type: 'get',
                    data: {
                        name: $('#name_tbk').val(),
                    },
                    url: "{{ route('scheduler.createNew') }}",
                    success: function(response) {
                        if (response.length != 0) {
                            $('#list_data').html(response.resultContainer);
                            $('#staticBackdrop').modal('hide');
                        }
                    },
                });
            });
        });
    </script>
@endsection
