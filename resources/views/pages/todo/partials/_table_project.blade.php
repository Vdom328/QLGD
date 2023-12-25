
<table class="table table-hover mb-0">
    <tbody>
        @foreach ( $project as $item )
            <tr>
                <th>{{ $item->name }}</th>
                <td class="text-end">
                    <button type="button" class="btn-dark-dark me-3" data-project-id="{{ $item->id }}" data-project-name="{{ $item->name }}">チョン</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
