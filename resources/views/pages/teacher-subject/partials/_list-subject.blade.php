@php
    use App\Classes\Enum\RoleUserEnum;
@endphp
@foreach ($data as $value)
    <tr>
        <td>{{ $value->subject->credits_no }}</td>
        <td>{{ $value->subject->name }}</td>
        <td>
            {{-- <input type="text" class="change_class form-control" value="{{ $value->class->name }}"
                data-id="{{ $value->id }}" @if (Auth()->user()->level() != RoleUserEnum::ADMIN->value) disabled @endif> --}}
                <select name="" id="" data-id="{{ $value->id }}" class="form-control change_class" @if (Auth()->user()->level() != RoleUserEnum::ADMIN->value) disabled @endif>
                    <option value=""></option>
                    @foreach ($class as $lop )
                        <option value="{{ $lop->id }}" @if ($lop->id == $value->class_id) selected @endif>{{ $lop->name }}</option>
                    @endforeach
                </select>
        </td>
        @if (Auth()->user()->level() == RoleUserEnum::ADMIN->value)
            <td class="text-end" style="width: 60px">
                <x-button type="button" class="btn-danger btn-block" id="" name="" :text="trans('common.btn.delete')"
                    attrs="data-bs-toggle=modal data-bs-target=#ajaxDelete" dataTitle="{{ trans('Xóa môn học ?') }}"
                    dataAction="{{ route('teacherSubject.delete', $value->id) }}"
                    dataMessage="Bạn có muốn xóa môn học này không ?" />
            </td>
        @endif
    </tr>
@endforeach
