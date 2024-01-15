<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm môn học cho sinh viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Tên môn học</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subject as $item)
                            <tr data_id = {{ $item->id }}  class="tr_table">
                                <td><input type="checkbox" value="{{ $item->id }}" 
                                    @if (isset($data) && $data->where('teacher_subject_id', $item->id)->count() >= 1) checked
                                    @endif class="form-check-input class"></td>
                                <td>{{ $item->subject->name }} - Lớp: {{ $item->class->name  ?? '' }} - GV: {{ $item->teacher->profile->full_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="create_subject" >Thêm</button>
            </div>
        </div>
    </div>
</div>

