<script type="text/javascript">
    // CONFIRMATION DELETE MODAL
    $(function() {
        $('#ajaxDelete').on('show.bs.modal', function(e) {
            var message = $(e.relatedTarget).attr('data-message');
            var title = $(e.relatedTarget).attr('data-title');
            var action = $(e.relatedTarget).attr('data-action');
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-title').text(title);
            $(this).find('#confirm').attr('data-action', action);
        });
        $('#ajaxDelete').find('.modal-footer #confirm').on('click', function() {
            var url = $(this).attr('data-action')
            $.ajax({
                url : url,
                method: 'DELETE',
            }).done(function (result) {
                $('#ajaxDelete').modal('hide');
            }).fail(function () {
                alert('エラーが発生しました。');
                $('#ajaxDelete').modal('hide');
            });
        });
    });
</script>