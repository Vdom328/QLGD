<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm môn học cho giảng viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Mã môn học</th>
                            <th scope="col">Tên môn học</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subject as $item)
                            <tr data_id = {{ $item->id }}  class="tr_table">
                                <td><input type="checkbox" name="class" id="" value="{{ $item->id }}" class="form-check-input" id="{{ $item->id }}"></td>
                                <th>{{ $item->credits_no }}</th>
                                <td>{{ $item->name }}</td>
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

