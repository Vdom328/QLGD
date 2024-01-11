
@foreach ($data as $student)
    <tr class="rowlink" data-action="">
        <td style="width: 150px">{!! $student->profile->staff_no !!}</td>
        <td style="width: 60px" class="text-center">
            @if ($student->profile->avatar)
                <img class="rounded-circle" src="{{ asset('storage/avatarUser/' . $student->profile->avatar) ?? '' }}"
                    alt="" width="35" height="35">
            @else
                <img class="rounded-circle" src="{{ Avatar::create($student->profile->fullname)->toBase64() }}" alt=""
                    width="35" height="35">
            @endif
        </td>
        <td><a class="text-decoration-underline"  href="{{ route('staffs.update', $student->id) }}">
                {!! $student->profile->fullname !!}
            </a></td>
        <td>{!! $student->email !!}</td>
        <td>

        </td>
        <td class="text-end">
            <a href="{{ route('student.update', $student->id) }}" class="btn-grey">Chỉnh sửa</a>
        </td>
    </tr>
@endforeach
