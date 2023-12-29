@foreach ($data as $item )
    <tr>
        <td><a href="{{ route('subject.update', $item->id) }}" class="text-decoration-underline">
            {{ $item->name }}
        </a></td>
        <td>{{ $item->credits_no }}</td>
        <td>
            @if ($item->status == Config::get('const.status.yes'))
                Có hiệu lực
            @else
                Vô hiệu hóa
            @endif
        </td>
        <td>{{ $item->quantity_credits }}</td>
    </tr>
@endforeach
