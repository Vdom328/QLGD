
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

        <td>
            <select name="select-room" id="" class="form-control select-room" subject-id="{{ $item->id }}">
                <option value=""></option>
                @foreach ($labs_room as $labs )
                    <option value="{{ $labs->id }}" @if (isset($item->subject_labs) && $item->subject_labs->class_room_id == $labs->id) selected  @endif>{{ $labs->name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <textarea name="description" id="" class="form-control description" subject-id="{{ $item->id }}">@if (isset($item->subject_labs))
                {{ $item->subject_labs->description }}
            @endif</textarea>
        </td>
    </tr>
@endforeach
