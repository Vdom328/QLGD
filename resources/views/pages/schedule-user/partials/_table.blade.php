@php
    use App\Classes\Enum\RoleUserEnum;
@endphp
<table class="table table-bordered" id="myTable">
    <thead class="thead-light">
        <tr>
            <th class="fw-bold text-center">Tiết</th>
            @foreach ($data as $day => $value)
                <th class="fw-bold text-center">
                    {{ $day }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php
            $time_slots = range(1, time_slots());$number = count($time_slots);
        @endphp
        @foreach ($time_slots as $time)
            <tr @if ($time <= $number/2) style="background: #dfdfdf" @else style="background: #f6efd8"  @endif>
                <td style="width:70px" class="fw-bold">Tiết: {{ $time }}</td>
                @foreach ($data as $day => $value)
                    <td class="text-center" style="vertical-align: top;">
                        @foreach ($value[$time] as $item)
                            <div @if (count($value[$time]) >= 2) style="border-bottom: 1px solid #ffff; background: linear-gradient(to left, #ffbdbd 98%, {{ $item['cl'] }} 2%);"
                        @else style="background: linear-gradient(to left, #afc8f0 98%, {{ $item['cl'] }} 2%);"  @endif
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
