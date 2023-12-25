@foreach ($todo as $item)
    <tr>
        <td class="text-end">
            @if ($item->isExpired())
                <img src="{{ asset('assets/images/icons/fire.png') }}" alt="" width="25px">
            @endif
            @if (App\Classes\Enum\TodoStatusEnum::new->value == $item->status)
                <img src="{{ asset('assets/images/icons/iconnew.png') }}" alt="" width="25px">
            @elseif (App\Classes\Enum\TodoStatusEnum::cancel->value == $item->status)
                <img src="{{ asset('assets/images/icons/cancel.png') }}" alt="" width="25px">
            @else
                <img src="{{ asset('assets/images/icons/ads.png') }}" alt="" width="15px" class="ms-2">
            @endif
        </td>
        <td class="@if ($item->isExpired()) text-danger @endif">
            {{ date('Y/m/d', strtotime($item->expired_date)) }}</td>
        <td>{{ App\Classes\Enum\TodoTypeEnum::from($item->type)->label() }}</td>

        <td><a href="{{ route('todo.update', $item->id) }}">{{ $item->title }}</a></td>
        <td>
            @if ($item->project_id)
                <a
                    href="{{ route('project.update', ['id' => $item->project_id]) }}">{{ $item->project->name ?? '' }}</a>
            @endif
        </td>
        <td></td>
        <td>{{ $item->created_at->format('Y/m/d') }}</td>
        <td>{{ $item->updated_at->format('Y/m/d') }}</td>
        <td>
            @if ($item->manager->profile->avatar == null)
                <img class="rounded-circle" src="{{ Avatar::create($item->manager->profile->fullname)->toBase64() }} "
                    alt="" width="35px" height="35px">
            @else
                <img class="rounded-circle" src="{{ asset('storage/avatarUser/' . $item->manager->profile->avatar) }}"
                    alt="" width="35px" height="35px">
            @endif
        </td>
        <td>
            @if ($item->registrar->profile->avatar == null)
                <img class="rounded-circle" src="{{ Avatar::create($item->registrar->profile->fullname)->toBase64() }}"
                    alt="" width="35px" height="35px">
            @else
                <img class="rounded-circle" src="{{ asset('storage/avatarUser/' . $item->registrar->profile->avatar) }}"
                    alt="" width="35px" height="35px">
            @endif
        </td>
    </tr>
@endforeach
