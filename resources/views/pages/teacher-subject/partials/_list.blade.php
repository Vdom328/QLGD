
@foreach ($data as $teacher)
    <tr class="rowlink" data-action="">
        <td style="width: 150px">{!! $teacher->profile->staff_no !!}</td>
        <td style="width: 60px" class="text-center">
            @if ($teacher->profile->avatar)
                <img class="rounded-circle" src="{{ asset('storage/avatarUser/' . $teacher->profile->avatar) ?? '' }}"
                    alt="" width="35" height="35">
            @else
                <img class="rounded-circle" src="{{ Avatar::create($teacher->profile->fullname)->toBase64() }}" alt=""
                    width="35" height="35">
            @endif
        </td>
        <td><a class="text-decoration-underline"  href="{{ route('staffs.update', $teacher->id) }}">
                {!! $teacher->profile->fullname !!}
            </a></td>
        <td>{!! $teacher->email !!}</td>
        <td>
            @foreach ($teacher->teacher_subject as $teacher_subject)
                <li>{{ $teacher_subject->subject->name }} - Lớp: {{ $teacher_subject->class }} </li>
            @endforeach
        </td>
        <td class="text-end">
            <a href="{{ route('teacherSubject.update', $teacher->id) }}" class="btn-grey">Chỉnh sửa</a>
        </td>
    </tr>
@endforeach
