@foreach ($staffs as $staff)
    <tr class="rowlink" data-action="">
        <td>{!! $staff->profile->staff_no !!}</td>
        <td class="text-center">
            @if ($staff->profile->avatar)
                <img class="rounded-circle" src="{{ asset('storage/avatarUser/' . $staff->profile->avatar) ?? '' }}"
                    alt="" width="35" height="35">
            @else
                <img class="rounded-circle" src="{{ Avatar::create($staff->profile->fullname)->toBase64() }}" alt=""
                    width="35" height="35">
            @endif
        </td>
        <td><a class="text-decoration-underline"  href="{{ route('staffs.update', $staff->id) }}">
                {!! $staff->profile->fullname !!}
            </a></td>
        <td><a class="text-decoration-underline"
                href="{{ route('staffs.update', $staff->id) }}">{!! $staff->email !!}</a></td>
        <td>{{ $staff->level() == \App\Classes\Enum\RoleUserEnum::ADMIN->value ? 'Admin' : 'Teacher' }}</td>
        <td>{!! $staff->created_at->format('Y/m/d') !!}</td>
        <td>{!! $staff->status == \App\Classes\Enum\StaffStatusEnum::VALID->value ? 'Có hiệu lực' : 'Vô hiệu hóa' !!}
        </td>
    </tr>
@endforeach
