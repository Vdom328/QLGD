<script>
    $(document).ready(function() {
        /**
         * click fillter and sort data
         */
        let url = window.location.href;
        let column = 'id';
        let direction = 'asc';
        // form filter
        $('#btn_filter').on('click', function() {
            ajaxdata(url, column, direction)
        });

        // checkbox filter
        $('#filter_me').on('change', function() {
            ajaxdata(url, column, direction)
        });

        //  sort column
        $(document).on('click', '.sort_table', function() {
            column = $(this).attr('data-column');
            direction = $(this).attr('data-direction');
            updateIcon($(this), column, direction);
            ajaxdata(url, column, direction);
        });

        // pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            ajaxdata(url, column, direction)
        });

        // call data
        function ajaxdata(url, column, direction) {
            var isChecked = $("#filter_me").prop("checked");
            console.log($('select[name="supplier_manager_staff_id"]').val());
            $.ajax({
                    type: 'get',
                    data: {
                        filter_me: isChecked,
                        filed_sort: column,
                        type_sort: direction,
                        category: $('.category').val(),
                        status_project: $('select[name="status"]').val(),
                        keywords: $('input[name="key"]').val(),
                        supplier_manager_id: $('select[name="supplier_manager_name"]').val(),
                        supplier_id: $('select[name="supplier_name"]').val(),
                        supplier_manager_staff_id: $('select[name="supplier_manager_staff_id"]').val(),
                        // formData: $("#form_filter").serializeArray(),
                    },
                    url: url,
                    success: function(response) {
                        if (response.length != 0) {
                            $('#list_project').html(response.resultContainer);
                            $('#paginate').html(response.paginate);
                        }
                    },
                });
        }

        // update icon
        function updateIcon(elemen, column, direction) {
            var icon = elemen.find(".fas");
            $('.icon_sort').removeClass('fa-sort-down fa-sort-up').addClass('fa-sort')
            if (direction == 'asc') {
                elemen.attr('data-direction', 'desc');
                icon.removeClass('fa-sort').addClass('fa-sort-down');
            } else {
                elemen.attr('data-direction', 'asc');
                icon.removeClass('fa-sort').addClass('fa-sort-up');
            }
        }
    })
</script>
