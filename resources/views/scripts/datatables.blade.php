{{-- FYI: Datatables do not support colspan or rowpan --}}

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.noConflict();
        var dt = $('.data-table').dataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "dom": 'T<"clear">lfrtip',
            "sPaginationType": "full_numbers",
            'aoColumnDefs': [{
                'bSortable': false,
                'searchable': false,
                'aTargets': ['no-search'],
                'bTargets': ['no-sort']
            }]
        });
    });
</script>