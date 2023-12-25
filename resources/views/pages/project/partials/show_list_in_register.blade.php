<div class="row p-3 bg-white rounded-3 customer_table_container">
    <table class="table table-hover ">
        <thead>
        <tr>
            <th>案件番号</th>
            <th>親案件</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr class="cursor-pointer @if(!empty($data['type']) && $data['type'] === 'select-parent') select-project-parent @else redirect-project-update @endif"
                @if(!empty($data['type']) && $data['type'] === 'select-parent')
                    data-id="{{ $project->id }}" data-name="{{ $project->name }}"
                @else data-href="{{ route('project.update', ['id' => $project->id])}}" @endif>
                <td>{{ $project->no }}</td>
                <td>{{ $project->name }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>
<div class="pagination  mt-3">
    {{ $projects->links('pagination::custom') }}
</div>


