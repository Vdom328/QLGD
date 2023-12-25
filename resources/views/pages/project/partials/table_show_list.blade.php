<div class="row p-3 bg-white rounded-3 customer_table_container">
    <table class="table table-hover ">
        <thead>
        <tr>
            <th>
                案件番号<i class="ms-1 fas fa-sort sort" data-filed-sort="no"></i>
            </th>
            <th>親案件</th>
            <th>状態<i class="ms-1 fas fa-sort sort" data-filed-sort="status"></i></th>
            <th>カテゴリ<i class="ms-1 fas fa-sort sort" data-filed-sort="category_id"></i></th>
            <th>案件名<i class="ms-1 fas fa-sort sort" data-filed-sort="name"></i></th>
            <th>取引先名<i class="ms-1 fas fa-sort sort" data-filed-sort="customer"></i></th>
            <th>
                登录日<i class="ms-1 fas fa-sort sort" data-filed-sort="order_date"></i>
            </th>
            <th>
                納期<i class="ms-1 fas fa-sort sort" data-filed-sort="exprire_date"></i>
            </th>
            <th>社内担当</th>
            <th>複製</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr class="cursor-pointer @if(!empty($data['type']) && $data['type'] === 'select-parent') select-project-parent @else redirect-project-update @endif"
                @if(!empty($data['type']) && $data['type'] === 'select-parent')
                    data-id="{{ $project->id }}" data-name="{{ $project->name }}"
                @else data-href="{{ route('project.update', ['id' => $project->id])}}" @endif>
                <td>{{ $project->no }}</td>
                <td>
                    <a href="{{ $project->parentProject ? route('project.update', ['id' => $project->parentProject->id]) : '#'  }}">
                        {{ $project->parentProject ? $project->parentProject->name : ''  }}
                    </a>
                </td>
                <td>{{ App\Classes\Enum\ProjectStatusEnum::getLabel($project->status) }}</td>
                <td>{{ $project->category->name }}</td>
                <td>
                    <a href="{{ route('project.update', ['id' => $project->id]) }}">{{ $project->name }}</a>
                </td>
                <td>
                    <a href="{{ $project->customer ? route('supplier.getEdit', ['id' => $project->customer->id]) : '#' }}">
                        {{ $project->customer ? $project->customer->name : ''  }}
                    </a>
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($project->order_date)->format('Y/m/d') }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($project->exprire_date)->format('Y/m/d') }}
                </td>
                <td>
                    <img class="rounded-circle"
                         src="{{ file_exists(public_path('storage/avatarUser/'.$project->avatar)) ? asset('storage/avatarUser/' . $staff->profile->avatar) : Avatar::create(Auth::user()->name)->toBase64() }}"
                         alt="" width="35px" height="35px">
                </td>
                <td>
                    <a href="{{ route('project.register', ['copyProjectId' => $project->id]) }}"><i class="fas fa-copy"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="pagination  mt-3">
    {{ $projects->links('pagination::custom') }}
</div>


