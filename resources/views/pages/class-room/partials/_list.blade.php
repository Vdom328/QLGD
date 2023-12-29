@foreach ($data as $item)
    <tr>
        <td style="width: 250px">
            <a href="{{ route('classroom.update', $item->id) }}" class="text-decoration-underline">
                {{ $item->name }}
            </a>
        </td>
        <td style="width: 60px">
            @if ($item->status == Config::get('const.status.yes'))
                Mở
            @else
                Đóng
            @endif
        </td>
        <td>{{ $item->description }}</td>
    </tr>
@endforeach
