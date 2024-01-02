@extends('layouts.app')

@section('template_linked_css')
    <style>
        .table {
            font-size: 10px;
        }

        .table td {
            padding: 3px;
            min-width: 100px !important;
        }
        .fade-right {
        position: relative;
    }

    .fade-right::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 50%; /* Điều chỉnh phần bên phải mờ mờ tùy thuộc vào chiều rộng bạn muốn */
        background: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1)); /* Hiệu ứng mờ mờ */
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
    </div>
@endsection

@section('content')
    <div>
        <div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
            <ul class="mb-0">
                @foreach ($schedule['missing_credits_subjects'] as $missing_credits_subjects)
                    <li class="text-danger">{{ $missing_credits_subjects }}</li>
                @endforeach
            </ul>
        </div>
        <div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm mt-3">
            <div class="container">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th></th>
                            @foreach ($schedule['class_rooms'] as $class_room)
                                <th>{{ $class_room->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedule['days'] as $day)
                            @foreach ($schedule['schedule'] as $key => $value)
                                @if ($key == $day)
                                    <tr>
                                        <td style="width:70px" class="fw-bold"
                                            rowspan="{{ count($schedule['time_slots']) + 1 }}">{{ $day }}</td>
                                    </tr>
                                    @foreach ($value as $time_slots => $class_rooms)
                                        <tr>
                                            <td style="width:80px" class="fw-bold">Tiết: {{ $time_slots }}<br></td>
                                            @foreach ($class_rooms as $class_room)
                                                {{-- <td @if (isset($class_room['cl'])) style="background:  {{ $class_room['cl'] }}" @endif> --}}
                                                <td>
                                                    @if (isset($class_room['ten_mon_hoc']))
                                                        Môn: {{ $class_room['ten_mon_hoc'] }}<br>
                                                        Lớp: {{ $class_room['lop'] }} - GV: {{ $class_room['gv'] }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
@endsection
