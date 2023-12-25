<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.ja.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
            language: 'ja',
            keyboardNavigation: false,
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
