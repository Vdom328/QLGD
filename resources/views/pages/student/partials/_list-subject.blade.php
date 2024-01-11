@foreach ($data as $value)
    <tr>
        <td>{{ $value->teacher_subject->subject->credits_no }}</td>
        <td>{{ $value->teacher_subject->subject->name }} - Lớp: {{ $value->teacher_subject->class }} - GV: {{ $value->teacher_subject->teacher->profile->full_name }}</td>
        <td class="text-end" style="width: 60px">
            <x-button type="button" class="btn-danger btn-block" id="" name="" :text="trans('common.btn.delete')" attrs="data-bs-toggle=modal data-bs-target=#ajaxDelete"
            dataTitle="{{trans('Xóa môn học ?')}}" dataAction="{{ route('student.delete',$value->id) }}"  dataMessage="Bạn có muốn xóa môn học này không ?"/>
        </td>
    </tr>
@endforeach
