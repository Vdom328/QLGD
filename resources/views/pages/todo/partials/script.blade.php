<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex ">
                <h5 class="modal-title col-7" id="staticBackdropLabel">
                    プロジェクトの一覧表示
                </h5>
                <div class="d-flex align-content-center col-4 flex-wrap position-relative">
                    <input type="text" placeholder="検索" class="form-control" id="sreach_project">
                </div>
                <button type="button" class="btn-close col-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">近い</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(function() {
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
        });
        // click add attachments
        $('#todo_attachments').click(function() {
            $('.attachments').click();
        });
        $('.attachments').change(function(e) {
            var files = e.target.files;
            var fileNames = '';
            for (var i = 0; i < files.length; i++) {
                fileNames += '<p class="mb-1">' + files[i].name + '</p>';
            }
            $('#selectedFiles').html(fileNames);
        });
        // submit
        $('#todo_form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('.error').html('').removeClass('mb-1');
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.location.href = response.url;
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    // messages validate
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(fieldName, errorMessages) {
                        fieldName = fieldName.replace('managers.', '');
                        fieldName = fieldName.replace('.', '_');
                        $('#error_' + fieldName).html(errorMessages).addClass(
                            'mb-1');
                    });
                }
            });
        });

        // click show modal list project
        let key = '';
        $(document).on("click", "#list_project", function() {
            ajaxProject(key = '');
        })

        $(document).on("keyup", "#sreach_project", function() {
            ajaxProject(key = $(this).val());
        });

        function ajaxProject(key)
        {
            let staff_id = $('#manager_id').val();
            $.ajax({
                type: 'get',
                url: "{{ route('todo.getProject') }}",
                data: {
                    staff_id: staff_id,
                    key: key
                },
                success: function(response) {
                    $('.modal-body').html(response.project_list);
                    $('#staticBackdrop').modal('show')
                },
            });
        }

        // click project
        $(document).on("click", "button[data-project-id]", function() {
            var projectId = $(this).data('project-id');
            var projectName = $(this).data('project-name');
            $('#project_name').text(projectName);
            $('#project_id').val(projectId);
            $('#staticBackdrop').modal('hide')
        });

    });
</script>
