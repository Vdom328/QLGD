<div class="row p-3 bg-white rounded-3 customer_table_container shadow-sm">
    <ul class="mb-0">
        @if ($schedule['schedule_error'] != '')
            @foreach ($schedule['schedule_error'] as $missing_credits_subjects)
                <li class="text-danger">{{ $missing_credits_subjects->error }}</li>
            @endforeach
        @endif
    </ul>
</div>
<div class="col-12 mt-3 d-flex flex-wrap align-items-center">
    <button type="button" data-bs-toggle="tooltip" id="exportButton" title="Xuất CSV" data-bs-placement="bottom"
        class="btn-shadow ms-3 btn btn-primary btn-add-new export-csv">
        <i class="fa-solid fa-file-export"></i>
        Xuất CSV
    </button>
    <a href="{{ route('scheduler.saveSchedule', $schedule['id']) }}" class="btn-shadow ms-3 btn btn-primary btn-add-new " >
        Dùng TKB
    </a>
</div>
<div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm mt-3">
    <div class="container">
        <table class="table table-bordered" id="myTable">
            <thead class="thead-light">
                <tr>
                    <th></th>
                    <th></th>
                    @foreach ($schedule['class_rooms'] as $class_room)
                        <th>{{ $class_room['name'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($schedule['schedule'] as $day => $value)
                    <tr>
                        <td style="width:70px" class="fw-bold" rowspan="{{ count($value) + 1 }}"> {{ $day }}
                        </td>
                    </tr>
                    @foreach ($value as $time_slots => $class_rooms)
                        <tr>
                            <td style="width:80px" class="fw-bold">Tiết: {{ $time_slots }}<br></td>
                            @foreach ($schedule['class_rooms'] as $room)
                                <td
                                    @if (isset($class_rooms[$room->id]['cl'])) style="background: linear-gradient(to left, #afc8f0 98%, {{ $class_rooms[$room->id]['cl'] }} 50%);"
                                        class="text-center" @endif>
                                    @if (isset($class_rooms[$room->id]['lop']))
                                        <span class="fw-bold">{{ $class_rooms[$room->id]['ten_mon_hoc'] }}</span>
                                        <span> Lớp: {{ $class_rooms[$room->id]['lop'] }}</span><br>
                                        <span style="color: #b64e4e" class="fw-bold">GV:
                                            {{ $class_rooms[$room->id]['gv'] }}</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

    </div>
</div>
