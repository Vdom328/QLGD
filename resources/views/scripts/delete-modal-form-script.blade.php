<script type="text/javascript">
    // CONFIRMATION DELETE MODAL
    $(function() {
        $('#confirmDelete').on('show.bs.modal', function(e) {
            var message = $(e.relatedTarget).attr('data-message');
            var title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-title').text(title);
        });
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function() {
            $("#frmDelete").submit();
        });
    });
</script>