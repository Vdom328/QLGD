@foreach ($projects as $project)
    <tr>
        <td>{{ $project->case_number }}</td>
        <td>{{ App\Classes\Enum\ProjectStatusEnum::getLabel($project->status) }}</td>
        <td>
            {{ $project->category->name }}
        </td>
        <td>
            <a href="{{ route('project.update', ['id' => $project->id]) }}"
                class="text-decoration-underline">{{ $project->name }}</a>
        </td>
        <td>
            @if (isset($project->supplier->id))
                <a href="{{ route('supplier.getEdit', ['id' => $project->supplier->id]) }}" class="text-decoration-underline">{{ $project->supplier->name }}</a>
            @endif
        </td>

        <td>
            @if ($project->is_exprire_date == \App\Classes\Enum\ProjectIsExprireDateEnum::OFF->value)
                <button type="button" class="btn-grey">未送付</button>
            @else
                <button type="button" class="btn-grey active-click">送付済</button>
            @endif
        </td>
        <td>
            @if (isset($project->supplier->supplier_managers))
                @foreach ($project->supplier->supplier_managers as $supplier_manager)
                    {{ $supplier_manager->name }}
                    @break
                @endforeach
            @endif
        </td>
        <td>
            @if (isset($project->supplier->supplier_managers))
                @foreach ($project->supplier->supplier_managers as $supplier_manager)
                    @if ($supplier_manager->staff->profile->avatar)
                        <img class="rounded-circle" src="{{ asset('storage/avatarUser/' . $supplier_manager->staff->profile->avatar) ?? '' }}" alt=""  width="35px" height="35px">
                    @else
                        <img class="rounded-circle" src="{{ Avatar::create($supplier_manager->staff->profile->fullname)->toBase64() }}" alt=""  width="35px" height="35px">
                    @endif
                    @break
                @endforeach
            @endif
        </td>
        <td>
            @if ($project->is_ordered == 0)
                <button type="button" class="btn-white">発注書</button>
            @else
                <button type="button" class="btn-grey active_white">発注書</button>
            @endif

        </td>
    </tr>
@endforeach
