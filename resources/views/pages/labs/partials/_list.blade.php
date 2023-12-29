@foreach ($data as $item )
    <tr>
        <td><a href="{{ route('subject.update', $item->id) }}" class="text-decoration-underline">
            {{ $item->name }}
        </a></td>
        <td>{{ $item->credits_no }}</td>
        <td>
            <select name="" id="" class="form-control">
                <option value=""></option>
                @foreach ($labs_room as $labs )
                    <option value="{{ $labs->id }}">{{ $labs->name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <textarea name="" id="" class="form-control"></textarea>
        </td>
    </tr>
@endforeach
