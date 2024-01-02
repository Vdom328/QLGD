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
        <td class="text-end" style="width: 60px">
            <x-button type="button" class="btn-danger btn-block" id="" name="" :text="trans('common.btn.delete')" attrs="data-bs-toggle=modal data-bs-target=#ajaxDelete"
            dataTitle="{{trans('Xóa môn học ?')}}" dataAction="{{ route('subject.delete', $item->id) }}"  dataMessage="Bạn có muốn xóa môn học này không ??"/>
        </td>
    </tr>
@endforeach
