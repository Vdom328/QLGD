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
        <td class="text-end" style="width: 60px">
            <x-button type="button" class="btn-danger btn-block" id="" name="" :text="trans('common.btn.delete')" attrs="data-bs-toggle=modal data-bs-target=#ajaxDelete"
            dataTitle="{{trans('Xóa phòng học ?')}}" dataAction="{{ route('subject.delete', $item->id) }}"  dataMessage="Bạn có muốn xóa phòng học này không ??"/>
        </td>
    </tr>
@endforeach
