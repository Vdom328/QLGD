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

        // click load supplier_code
        $(document).on("click", "#auto-gen", function() {
            $.ajax({
                type: "GET",
                url: "{{ route('supplier.supplier_code') }}",
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
        // add tr table supplier manager
        let managersCount = $('.form_manager').length;
        $(document).on("click", "#add_supplier_manager", function() {
            $.ajax({
                type: "GET",
                url: "{{ route('supplier.create.render') }}",
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
                    // window.location.href = "{{ route('supplier.index') }}";
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
