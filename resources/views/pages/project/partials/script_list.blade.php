<script>
    $(document).ready(function () {
        /* Click status, add or remove class action in this button status */
        $('.button-status').click(function () {
            // Add or Remove class action in this button status
            $(this).hasClass('active') ? $(this).removeClass('active') : $(this).addClass('active');
        })

        /* Show List*/
        ajaxFilter()

        /* Pagination */
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault()
            let url = $(this).attr('href')
            let urlObject = new URL(url)
            let pageNumber = urlObject.searchParams.get('page')
            if (pageNumber !== null) {
                ajaxFilter({page: pageNumber})
            }
        });

        /* Fn get filter present */
        function listFiledFilter() {
            let dataStatus = $('.group-status .button-status').filter(".active").map(function () {
                return $(this).data("value");
            }).get()
            let category = $('#category').val()
            let keywords = $('#keywords').val()
            let filed_sort = $('#filed_sort').val()
            let type_sort = $('#type_sort').val()
            let staff_id = $('#staff_id').val()
            let customer_id = $('#customer_id').val()
            let supplier_id = $('#supplier_id').val()
            return {
                dataStatus: dataStatus,
                category: category,
                keywords: keywords,
                filed_sort: filed_sort,
                type_sort: type_sort,
                staff_id: staff_id,
                customer_id: customer_id,
                supplier_id: supplier_id
            }
        }

        /* Action filter */
        $('#btn_filter').click(function () {
            /* Reset sort when filter */
            $('#filed_sort').val('')
            $('#type_sort').val('')
            ajaxFilter()
        })

        /* Action filter me (checkbox) */
        $('#filter_me').click(function () {
            let value = $(this).prop('checked')
            ajaxFilter({filter_me: value})
        })

        /* Ajax filter */
        function ajaxFilter(dataAddFilter = null) {
            let dataFilter = dataAddFilter ? {...dataAddFilter, ...listFiledFilter()} : listFiledFilter()
            $.ajax({
                url: "{{ route('project.filter') }}",
                type: 'GET',
                data: dataFilter,
                success: function (response) {
                    $('.show-table').html(response)
                }
            })
        }

        /* Sort */
        $(document).on('click', '.fa-sort.sort', function () {
            let filedSort = $(this).data('filed-sort')
            let typeSort = 'desc'
            if (filedSort === $('#filed_sort').val()) {
                typeSort = $('#type_sort').val() === 'desc' ? 'asc' : 'desc'
            }
            $('#filed_sort').val(filedSort)
            $('#type_sort').val(typeSort)
            ajaxFilter()
        })

        /* Redirect to project update */
        $(document).on('click', '.redirect-project-update', function () {
            $("#sk-spinner").removeClass("d-none");
            window.location.href = $(this).data('href')
        })

        /* Copy data project, redirect to register and pasted data */
        $(document).on('click', '.redirect-project-update', function () {
            $("#sk-spinner").removeClass("d-none");
            window.location.href = $(this).data('href')
        })
    })
</script>
