@foreach ($projects as $project)
    <tr>
        <td>{{ $project->case_number }}</td>
        <td>{{ App\Classes\Enum\ProjectStatusEnum::getLabel($project->status) }}</td>
        <td>
            {{ $project->category->name }}
        </td>
        <td>
            <a href="" class="text-decoration-underline">{{ $project->name }}</a>
        </td>
        <td>
            @if ($project->customer)
                <a href="" class="text-decoration-underline">{{ $project->customer->name }}</a>
            @endif
        </td>
        <td>{{ $project->customer_manager_id }}</td>
        <td>
            @if ($project->staff)
                @if ($project->staff->profile->avatar)
                    <img src="{{ Avatar::create($project->staff->profile->avatar)->toBase64() }}" alt=""
                        width="35px" height="35px">
                @else
                    <img src="{{ Avatar::create($project->staff->profile->fullname)->toBase64() }}" alt=""
                        width="35px" height="35px">
                @endif
            @endif
        </td>
        <td><button type="button" class="btn-grey">見積書</button></td>
        <td><button type="button" class="btn-white">請求書</button></td>
    </tr>
@endforeach
