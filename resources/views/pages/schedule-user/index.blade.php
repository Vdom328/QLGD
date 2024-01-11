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
    <div id="list_data" class="mt-4">
        <div class="col-12 mt-3 d-flex flex-wrap align-items-center">
            <button type="button" data-bs-toggle="tooltip" id="exportButton" title="Xuất CSV" data-bs-placement="bottom"
                class="btn-shadow ms-3 btn btn-primary btn-add-new export-csv">
                <i class="fa-solid fa-file-export"></i>
                Xuất CSV
            </button>
        </div>
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm mt-3">
            <div class="container">
                <table class="table table-bordered" id="myTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="fw-bold text-center">Ca dậy</th>
                            @foreach ($data as $day => $value)
                                <th class="fw-bold text-center">
                                    {{ $day }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $time_slots = range(1, time_slots());
                        @endphp
                        @foreach ($time_slots as $time)
                            <tr>
                                <td style="width:70px" class="fw-bold">Tiết: {{ $time }}</td>
                                @foreach ($data as $day => $value)
                                    <td class="text-center" style="vertical-align: top;">
                                        @foreach ($value[$time] as $item)
                                            <div @if (count($value[$time]) >= 2) style="border-bottom: 1px solid #ffff; background: linear-gradient(to left, #cd8989 98%, {{ $item['cl'] }} 2%);"
                                        @else style="background: linear-gradient(to left, #89a3cd 98%, {{ $item['cl'] }} 2%);"  @endif
                                            >
                                                <span class="fw-bold">{{ $item['ten_mon_hoc'] }}</span>
                                                <span>Lớp: {{ $item['lop'] }}</span><br>
                                                <span style="color: #b64e4e" class="fw-bold">Phòng:
                                                    {{ $item['phong'] }}</span>
                                                @if (Auth()->user()->level() == RoleUserEnum::STUDENT->value)
                                                    <br>
                                                    <span class="fw-bold">GV:
                                                        {{ $item['gv'] }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        });
    </script>
@endsection
