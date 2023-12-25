<script>
    $(document).ready(function() {
        // Show company information on initial load
        $("#companyInfoTab").addClass("active-click");
        $("#projectInfoTab").removeClass("active-click");

        $("#project_information").addClass("d-none");
        $("#company_information").removeClass("d-none");

        // $("#project_information").removeClass("d-none");
        //     $("#company_information").addClass("d-none");
        // Handle click events
        $("#companyInfoTab").click(function() {
            $("#companyInfoTab").addClass("active-click");
            $("#projectInfoTab").removeClass("active-click");

            $("#company_information").removeClass("d-none");
            $("#project_information").addClass("d-none");
        });

        $("#projectInfoTab").click(function() {
            $("#projectInfoTab").addClass("active-click");
            $("#companyInfoTab").removeClass("active-click");

            $("#project_information").removeClass("d-none");
            $("#company_information").addClass("d-none");
        });

        // click load customer
        $(document).on("click", "#auto-gen", function() {
            $.ajax({
                type: "GET",
                url: "{{ route('customer.customer_code') }}",
                data: {},
                success: function(data) {
                    $('input[name="code"]').val(data.code);
                },
            });
        });

        // post code
        $('#postcode-first').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
            if ($(this).val().length > 3) {
                $(this).val($(this).val().slice(0, 3));
            }
        });

        $('#postcode-last').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
            if ($(this).val().length > 4) {
                $(this).val($(this).val().slice(0, 4));
            }
        });


        // code
        $('.code').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
            if ($(this).val().length > 5) {
                $(this).val($(this).val().slice(0, 5));
            }
        });
        $('.number').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });

        // add tr table customer manager
        let managersCount = $('.form_manager').length;
        $(document).on("click", "#add_customer_manager", function() {
            $.ajax({
                type: "GET",
                url: "{{ route('customer.create.render') }}",
                data: {
                    managersCount: managersCount,
                },
                success: function(data) {
                    $('#body_table_manager').append(data.resultContainer);
                    managersCount++;

                    $('.select_staff').select2({
                        templateResult: formatStaffOption,
                        templateSelection: formatStaffOption
                    });

                    $('.number').on('input', function() {
                        $(this).val($(this).val().replace(/[^0-9]/g, ''));
                    });
                }
            });
        });

        // submit form
        $('#company_information').submit(function(e) {
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

        var column = 'case_number';
        var direction = 'asc';

        $('#btn-submit-form').on('click', function() {
            filterAndSearch(column, direction);
        });

        $('#filter_project').on('change', function() {
            filterAndSearch(column, direction);
        });

        $('.sort_table').on('click', function() {
            var column = $(this).data('column');
            var currentDirection = $(this).data('direction');

            var newDirection = currentDirection === 'asc' ? 'desc' : 'asc';

            $(this).find('i').removeClass('fa-sort fa-sort-up fa-sort-down');
            $(this).find('i').addClass(newDirection === 'asc' ? 'fa-sort-up' : 'fa-sort-down');

            $(this).data('direction', newDirection);

            filterAndSearch(column, newDirection);
        });

        function filterAndSearch(column, direction) {
            var formData = $('#form-search').serialize();

            var filterProject = $('#filter_project').prop('checked');

            formData += '&filter_project=' + (filterProject ? 'true' : 'false');

            formData += '&sort_column=' + column;
            formData += '&sort_direction=' + direction;

            $.ajax({
                type: 'GET',
                url: "{{ route('customer.search.filter') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#projects_table').html(response.resultcontainer)
                    $("#project_paginate").html(response.projectpaginate);
                },
                error: function(xhr, status, error) {}
            });
        }

        $('.select_staff').select2({
            templateResult: formatStaffOption,
            templateSelection: formatStaffOption
        });

        function formatStaffOption(option) {
            var imgSrc = $(option.element).data('image');
            if (imgSrc) {
                return $('<span><img src="' + imgSrc + '" class="staff-image" /> ' + option.text + '</span>');
            }
            return option.text;
        }

        var resultsContainer = $('#projects_table');
        var projectpaginate = $("#project_paginate");
        $(function() {
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getProjects(url);
                window.history.pushState("", "", url);
            });

            function getProjects(url) {
                $.ajax({
                    url: url,
                    type: 'GET'
                }).done(function(result) {
                    if (result.length != 0) {
                        resultsContainer.html(result.resultcontainer);
                        projectpaginate.html(result.projectpaginate);
                    }
                }).fail(function() {
                    alert('Projects could not be loaded.');
                });
            }
        });

        // remove staff
        var formManagerCount = $('.form_manager').length;
        if (formManagerCount <= 1) {
            $('.btn_remove').remove();
        }
        $(document).on('click', '.remove_customer_manager', function() {
            $(this).closest('.form_manager').next().remove();
            $(this).closest('.form_manager').remove();
            formManagerCount = $('.form_manager').length;
            if (formManagerCount <= 1) {
                $('.btn_remove').remove();
            }
        });
    });
</script>
