<script>
    $(document).ready(function () {

        /* Global variable */
        let globalRoute = {
            route_automatic: "{{ route('project.automatic.no') }}",
            route_saveOrUpdateRegister: "{{ route('project.saveOrUpdateRegister') }}",
            route_showListInRegister: "{{ route('project.showListInRegister') }}",
            route_showCustomerByStaff: "{{ route('project.showCustomerByStaff') }}",
            route_showProducts: "{{ route('project.showProducts') }}"
        }

        let globalStatusShowProject = {
            href: 'href',
            select: 'select-parent'
        }
        let globalStatusShowProjectPresent

        /********        Form 1         *************/
        /* Automatic when click button in field "no" */
        $('#automatic-no').on('click', function () {
            $('#no').removeClass('is-invalid')
                .siblings('.error').text('');
            $.ajax({
                url: globalRoute.route_automatic,
                success: function (response) {
                    $('#no').val(response.no)
                }
            })
        })

        /* Delete when entering filed "no" negative numbers */
        $('#no').on('keyup', function () {
            if ($(this).val() <= 0) {
                $(this).val('')
            }
        })

        /* Delete when entering filed negative numbers , text*/
        $(document).on('keyup', '.est-product-price .border-contenteditable, .est-product-quantity .border-contenteditable, .est-product-purchase_price .border-contenteditable, .price-shipping-fee div[contenteditable="true"]', function () {
            let value = $(this).text()
            if (Number(value) < 0 || isNaN(Number(value))) {
                $(this).text('')
            }
        })

        /* Change edit href related_file */
        /* - Href hidden, show input enter data */
        $(document).on('click', '.edit-related-file', function () {
            $(this)
                .siblings('.input-container-related')
                .removeClass('d-none')
                .children('.input-related-file').val($(this).siblings('.href-related-file').text().replace(/\s+/g, ''))
            $(this)
                .siblings('.href-related-file').addClass('d-none')
                .siblings('.remove-related-file').addClass('d-none')
            $(this).addClass('d-none')
        })

        /* Remove link related file */
        $(document).on('click', '.remove-related-file', function () {
            $(this).parent().remove()
            classColgroupRelatedFiles(true)
        })

        /* - When click icon DONE => assign input_value -> href_value, hidden input, show href  */
        $(document).on('click', '.done-related', function () {
            let value = $(this).siblings('.input-related-file').val().replace(/\s+/g, '')
            if (value !== '') {
                $(this).parent()
                    .addClass('d-none')
                    .siblings('.href-related-file').text(value).attr("href", value).attr("title", value).removeClass('d-none')
                    .siblings('.edit-related-file').removeClass('d-none')
                    .siblings('.remove-related-file').removeClass('d-none')
            }
        })

        /* Cancel edit input  */
        $(document).on('click', '.cancel-related', function () {
            let valueHref = $(this).parent().siblings('.href-related-file').text()
            $(this).parent()
                .addClass('d-none')
                .siblings('.href-related-file').removeClass('d-none')
            if (valueHref !== '') {
                $(this).parent()
                    .siblings('.edit-related-file').removeClass('d-none')
                    .siblings('.remove-related-file').removeClass('d-none')
            } else {
                $(this).parent().parent().remove()
                classColgroupRelatedFiles(true)
            }
        })

        /* - Add related file new when click button + */
        $('.add-related-file').on('click', function () {
            classColgroupRelatedFiles(false)
            $('.group-related-files').append(`@include('pages.project.partials.form_add_related_file_register')`)
        })

        /* Add or remove class form group input */
        function classColgroupRelatedFiles(remove = true) {
            let groupRelatedFiles = $('.group-related-files')
            if ($('.group-related-files > div').length === 0) {
                !remove ? groupRelatedFiles.addClass('col-4').addClass('ms-5') : groupRelatedFiles.removeClass('col-4').removeClass('mx-5')
            }
        }

        /* Submit form */
        $('#formProject').submit(function (e) {
            e.preventDefault()
            // check validate form
            let isValid = validateFormProject()
            if (isValid) {
                ajaxSubmit()
            }
        })

        /* Get data in form */
        function getDataForm() {
            let formData = $('#formProject').serializeArray();
            let data = {}
            $.each(formData, function (index, field) {
                if (field.name.endsWith("[]")) {
                    if (!data[field.name]) {
                        data[field.name] = [];
                    }
                    data[field.name].push(field.value);
                } else {
                    data[field.name] = field.value;
                }
            })
            return data
        }

        /* Ajax submit form */
        function ajaxSubmit(dataAdd = null) {
            let dataForm = getDataForm()
            /* Data in table product ets items "見積り項目作成" */
            let productsEst = {
                'data_products_est': getDataFormTableProduct(),
                'data_memo_products_est': getDataMemoEstProduct(),
                'data_shipping_fees_products_est': getDataShippingFees()
            }
            let dataSubmit = {...productsEst, ...dataForm}

            let data = dataAdd ? {...dataAdd, ...dataSubmit} : dataSubmit
            $.ajax({
                type: "POST",
                url: globalRoute.route_saveOrUpdateRegister,
                data: data,
                success: function (response) {
                    if (response.success) {
                        /* Success */
                        showAlert('更新成功。', $('#success-alert'))
                    } else if (response.errors && Object.values(response.errors).length > 0) {
                        /* errors validate: Request BE */
                        let errors = response.errors
                        Object.keys(errors).forEach(key => {
                            $('#' + key).addClass('is-invalid')
                                .siblings('.error').text(errors[key][0]);
                        })

                    } else if (response.data && response.data.filedNoError) {
                        /* errors validate: filed "no" is existed */
                        $('#no').addClass('is-invalid')
                            .siblings('.error').text('値はすでに存在します。別の名前を選択してください。');

                    }
                    /* errors validate: error code, check Log */
                    else {
                        showAlert('エラーが発生しました！', $('#error-alert'))
                        //resetFormValue()
                    }
                    /*  Drag the page scroll bar up */
                    $('html, body').animate({scrollTop: 0}, 'fast');
                }
            })
        }

        /* Form Validated */
        function validateFormProject() {
            let isValid = true;

            /* Field is validated */
            let elementsToCheck = [
                $('#category_id'),
                $('#no'),
                $('#name'),
                $('#status'),
                $('#exprire_date'),
                $('#receipt_order_date')
            ]

            /* Check validate */
            elementsToCheck.forEach(function (element) {
                if (!checkRequired(element)) {
                    isValid = false
                }
            })

            /* Scroll the page upwards with the first element containing the error */
            if (!isValid) {
                let firstErrorElement = $('.is-invalid:visible').first();
                let scrollToY = firstErrorElement.offset().top - 200;
                $('html, body').animate({
                    scrollTop: scrollToY
                });
            }
            return isValid
        }

        /* Check whether the field is filled or not, if not, an error is displayed */
        function checkRequired(element) {
            if (element.val() === '') {
                let textElement = element.parent().siblings('.text-md-end').text()
                element.addClass('is-invalid')
                element.siblings('.error').text(textElement + ' は、必ず指定してください。')
                return false
            }
            return true
        }

        /* Remove error message when re-entering the field */
        // Input
        $('input').on('input click', function () {
            $(this).removeClass('is-invalid')
            $(this).siblings('.error').text('');
        });

        // Select
        const selectElements = $('select');
        selectElements.on('change', function () {
            $(this).removeClass('is-invalid')
            $(this).siblings('.error').text('');
        })

        /* Show alert success */
        function showAlert(message, element) {
            let alert = element
            alert.text(message)
            alert.removeClass('d-none')
            setTimeout(function () {
                alert.addClass('d-none')
                window.location.reload()
            }, 2000);
        }

        /* Reset value in form data */
        function resetFormValue() {
            $('#formProject :input').each(function () {
                let fieldType = this.type
                let tagName = this.tagName.toLowerCase()
                console.log(fieldType, tagName)
                let typeValue = ['text', 'password', 'textarea', 'number', 'date']
                let typeChecked = ['radio', 'checkbox']

                if (typeValue.includes(fieldType)) {
                    $(this).val('')
                } else if (typeChecked.includes(fieldType)) {
                    this.checked = false
                } else if (tagName === 'select') {
                    $(this).val('')
                }
            })
            resetShowValidation()
        }

        /* Reset all field error validate */
        function resetShowValidation() {
            $('#formProject .is-invalid').removeClass('is-invalid')
            $('#formProject .error').text('')
        }

        /* Change select category */
        $('#category_id').change(function () {
            let param = $(this).val() !== '' ? "?category_id=" + $(this).val() : '';
            $("#sk-spinner").removeClass("d-none");
            window.location.href = window.location.href.split("?")[0] + param
        })


        /* click button search in parent  */
        $('.show-projects-parent').click(function () {
            globalStatusShowProjectPresent = globalStatusShowProject.select
            ajaxShowModalProject(globalStatusShowProjectPresent)
        })

        /* click button "過去案件から作成"  */
        $('.show-projects-href').click(function () {
            globalStatusShowProjectPresent = globalStatusShowProject.href
            ajaxShowModalProject(globalStatusShowProjectPresent)
        })

        /* Pagination */
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault()
            let url = $(this).attr('href')
            let urlObject = new URL(url)
            let pageNumber = urlObject.searchParams.get('page')
            if (pageNumber !== null) {
                ajaxShowModalProject(globalStatusShowProjectPresent, {page: pageNumber})
            }
        });

        /* Func show Modal list projects */
        function ajaxShowModalProject(type = 'href', dataAdd = null) {
            let dataDefault = {
                type: type,
                totalPages: 10
            }
            let data = dataAdd ? {...dataAdd, ...dataDefault} : dataDefault
            $.ajax({
                url: globalRoute.route_showListInRegister,
                type: 'GET',
                data: data,
                success: function (response) {
                    $('.show-table').html(response)
                    $('#showProjects')
                        .attr('data-type', type)
                        .attr('data-route', globalRoute.route_showListInRegister)
                        .modal('show')
                }
            })
        }

        /* Redirect to project */
        $(document).on('click', '.redirect-project-update', function () {
            $("#sk-spinner").removeClass("d-none");
            window.location.href = $(this).data('href')
        })

        /* Select project parent */
        $(document).on('click', '.select-project-parent', function () {
            /* Select is the field you just selected to delete */
            if (Number($('#parent_id').val()) === Number($(this).data('id'))) {
                $('#parent_id').val('')
                $('#parent_name').val('')
            } else {
                $('#parent_id').val($(this).data('id'))
                $('#parent_name').val($(this).data('name'))
            }
            $('#showProjects').modal('hide')
        })

        /* Select change staff_id - "社内担当" */
        $('#staff_id').change(function () {
            $('#customer_id').val('')
            $('#customer_name').val('')
            $('#customer_manager_id').val('')
            $('#customer_manager_name').val('')
            $('#shipping_address').val('')
        })

        /* Show modal customer by staffId*/
        $('.customer-show').click(function () {
            if ($('#staff_id').val() !== '') {
                ajaxShowCustomerByStaff($('#staff_id').val());
            }
        })

        /* Ajax show customer */
        function ajaxShowCustomerByStaff(staff_id) {
            $.ajax({
                url: globalRoute.route_showCustomerByStaff,
                type: 'GET',
                data: {
                    staff_id: staff_id
                },
                success: function (response) {
                    $('.show-table').html(response)
                    $('#showProjects').modal('show')
                }
            })
        }

        /*Select customer */
        $(document).on('click', '.customer-selected', function () {
            /* Select is the field you just selected to delete */
            if (Number($('#customer_id').val()) === Number($(this).data('id'))) {
                $('#customer_id').val('')
                $('#customer_name').val('')
                $('#customer_manager_id').val('')
                $('#customer_manager_name').val('')
                $('#shipping_address').val('')
            } else {
                $('#customer_id').val($(this).data('id'))
                $('#customer_name').val($(this).data('name'))
                $('#shipping_address').val($(this).data('address'))
                $('#customer_manager_id').val($(this).data('id-manager'))
                $('#customer_manager_name').val($(this).data('name-manager'))
            }

            $('#showProjects').modal('hide')
        })


        /********        Estimate item (form 2)         *************/

        /* Click add editable text */
        $('.add-text-button').click(function () {
            /* Just add 1 row */
            if ($('.group-editable-text').children().length === 0) {
                $('.group-editable-text')
                    .append(`@include('pages.project.partials.estimate_items.editable_text')`)
            }
        })

        /* Remove row editable text "テキスト追加" */
        $(document).on('click', '.remove-editable-text', function () {
            $(this).parent().remove()
        })

        /* Click add shipping fees */
        $('.add-shipping-fees-button').click(function () {
            /* Just add 1 row */
            if ($('.add-shipping-fees').children().length === 0) {
                $('.add-shipping-fees')
                    .append(`@include('pages.project.partials.estimate_items.shipping_fees')`)
            }
        })

        /* Click button add product "商品追加" */
        $('.add-product-button').click(function () {
            ajaxShowModalProduct()
        })

        /* Ajax show modal product */
        function ajaxShowModalProduct(dataAdd = null) {
            let dataDefault = {
                category_id: $('#category_id').val(),
                idsProduct: listIdProductHad()
            }
            let data = dataAdd ? {...dataAdd, ...dataDefault} : dataDefault
            $.ajax({
                type: "GET",
                data: data,
                url: globalRoute.route_showProducts,
                success: function (response) {
                    $('.show-table').html(response)
                    $('#showProducts')
                        .attr('data-route', globalRoute.route_showProducts)
                        .modal('show')
                }
            })
        }

        /* Check box all when modal show list products */
        $(document).on('click', '.check-all-products', function () {
            let isChecked = $(this).prop("checked")
            $(".check-product").prop("checked", isChecked)
            // $('.check-product').each(function () {
            //     let product = $(this)
            //     isChecked ? addRowTableEst(product) : removeRowTableEst(product)
            // })
        })

        $('.add-products-checkbox').click(function () {
            $('.check-product').each(function () {
                let product = $(this)
                product.prop("checked") ? addRowTableEst(product) : removeRowTableEst(product)
                calculateTotalAll()
            })
        })

        /* Check box product when model show list products */
        // $(document).on('click', '.check-product', function () {
        //     let isChecked = $(this).prop("checked")
        //     let product = $(this)
        //     isChecked ? addRowTableEst(product) : removeRowTableEst(product)
        // })

        /* Add row in table estimate when click checkbox product */
        function addRowTableEst(product) {
            let checkIsset = false
            let productId = product.parent().parent().data("id")
            let supplierAmountId = product.parent().parent().data("supplier-amount-id")

            /* Check to see if the product has been added yet */
            $(".estimate-items-tbody tr").each(function () {
                if ($(this).data('id') === productId) {
                    checkIsset = true
                }
            })

            /* Get the current supplier by select option modal */
            let currentSupplier = $('#supplies-select').val()
            let currentSupplierName = $('#supplies-select option:selected').text()

            /* Assign value to hidden input */
            $('#supplier_id_hidden').val(currentSupplier)
            $('#supplier_name_hidden').val(currentSupplierName)

            /* Assign value to product add handmade */
            $('.est-product-supplier div').html(currentSupplierName)

            /* Assign text to supplier name */
            $('.supplier-name').html(currentSupplierName)

            if (!checkIsset) {
                let newRow = $(`<tr data-id="${productId}" data-supplier_id=${currentSupplier} data-supplier-amount-id=${supplierAmountId}>`)
                $(".estimate-table thead th").each(function () {
                    let columnFiled = $(this).data("filed");
                    let valueColumnFiled = getValueProduct(columnFiled, product)
                    if (columnFiled === 'remove') {
                        newRow.append(
                            `<td data-filed="${columnFiled}">
                            <div class="d-flex justify-content-end">
                                <div style="position: unset !important;" class="circular-button remove-product-row">x</div>
                            </div>
                            </td>`)
                    } else {
                        newRow.append(`<td data-value="${valueColumnFiled}" data-filed="${columnFiled}">${formatValueColumnFiled(columnFiled, valueColumnFiled)}</td>`)
                    }

                });
                $(".estimate-table .estimate-items-tbody").append(newRow)
            }

        }

        /* Format*/
        function formatValueColumnFiled(filed = null, value) {
            if (filed === 'price' || filed === 'quantity' || filed === 'total' || !filed) {
                return value !== '' ? Number(value).toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 }) : value
            }
            return value
        }


        /* Check to see if row product has any elements, if not, delete hidden values, default value =>  is empty */
        function checkLengthEstimateItemProduct() {
            let items = $(".estimate-table .estimate-items-tbody tr")
            if (items.length === 0) {
                $('.supplier-name').html('')
                $('#supplier_id_hidden').val('')
                $('#supplier_name_hidden').val('')
            }
            return items.length
        }

        /* Remove row in table est when unchecked checkbox product */
        function removeRowTableEst(product = null, supplierId = null) {
            $(".estimate-table .estimate-items-tbody tr").each(function () {
                if (product && $(this).data("id") === product.parent().parent().data("id")) {
                    $(this).remove()
                    checkLengthEstimateItemProduct()
                } else if (supplierId && $(this).data("supplier_id") !== supplierId) {
                    /* Delete suppliers that are not similar to the selected supplier */
                    $(this).remove()
                    checkLengthEstimateItemProduct()
                }
            })

        }

        /* Get the data value of the product in the show product modal */
        function getValueProduct(dataFiled, data) {
            return data.parent().parent().data(dataFiled) || ''
        }

        /* Remove product in table est items */
        $(document).on('click', '.remove-product-row', function () {
            $(this).parent().parent().parent().remove()
            checkLengthEstimateItemProduct()
            calculateTotalAll()
        })

        /* Add row product handmade */
        $('.add-product-handmade').click(function () {
            let newRow = $(`<tr>`)
            $(".estimate-table thead th").each(function () {
                let columnFiled = $(this).data("filed");
                if (columnFiled === 'remove') {
                    newRow.append(
                        `<td data-filed="${columnFiled}">
                            <div class="d-flex justify-content-end">
                                <div style="position: unset !important;" class="circular-button remove-product-row">x</div>
                            </div>
                        </td>`)
                } else if (columnFiled === 'supplier') {
                    newRow.append(`<td data-filed="${columnFiled}" class="est-product-${columnFiled}"><div>${$('#supplier_name_hidden').val()}</div></td>`)
                } else if (columnFiled === 'total') {
                    newRow.append(`<td data-filed="${columnFiled}" class="est-product-${columnFiled}"><div></div></td>`)
                }  else {
                    newRow.append(`<td data-filed="${columnFiled}" class="est-product-${columnFiled}"><div class="border-contenteditable" contenteditable="true"></div></td>`)
                }

            });
            $(".estimate-table .estimate-items-tbody").append(newRow)
        })

        /* key up quantity */
        $(document).on('keyup', '.est-product-quantity div, .est-product-price div, .est-product-purchase_price div', function() {
            calculateTotalAll()
        })

        /* Calculate total when changing quantity or price (total = price * quantity) */
        function calculateTotal(price, quantity) {
            if (price !== '' && quantity !== '') {
                let total = Number(price) * Number(quantity)
                $('.est-product-total div').text(formatValueColumnFiled('total', total))
            } else {
                $('.est-product-total div').text('')
            }
        }

        /* Calculate the price of the product's items and total them all */
        function calculateTotalAll() {
            let totalPurchase = 0
            let totalEst = 0

            $('.estimate-items-tbody tr').each(function () {
                /* product handmade */
                let price = $(this).find('.est-product-price div').text()
                let quantity = $(this).find('.est-product-quantity div').text()
                let purchase = $(this).find('.est-product-purchase_price div').text()

                /* product system */

                let priceSystem = $(this).find('[data-filed="price"]:not(:has(div))').text()
                let quantitySystem = $(this).find('[data-filed="quantity"]:not(:has(div))').text()

                /* Purchase 仕入れ小計 */
                if (purchase !== '' && quantity !== '' ) {
                    totalPurchase+= parseFloat(purchase) * parseFloat(quantity)
                }
                /* Est 見積り小計 */
                if ((price !== '' && quantity !== '')) {
                    let totalRow = parseFloat(price) * parseFloat(quantity)
                    totalEst+=totalRow
                    $(this).find('.est-product-total div').text(formatValueColumnFiled('total', totalRow))
                } else {
                    $(this).find('.est-product-total div').text('')
                }

                if (priceSystem !== '' && quantitySystem !== '') {
                    totalEst+= parseFloat(priceSystem.replace(/,/g, '')) * parseFloat(quantitySystem.replace(/,/g, ''))
                }


            })

            totalPurchase = totalPurchase === 0 ? '' : totalPurchase
            totalEst = totalEst === 0 ? '' : totalEst

            let totalPurchasePercent = totalPurchase === '' ? '' : formatValueColumnFiled(null, totalPurchase/10)
            let totalPurchaseSum = totalPurchase === '' ? '' : formatValueColumnFiled(null,totalPurchase + totalPurchase/10)
            $('.total-purchase-price .total-price').text(formatValueColumnFiled(null, totalPurchase))
            $('.total-purchase-price .percent-price').text(totalPurchasePercent)
            $('.total-purchase-price .sum-price').text(totalPurchaseSum)

            let totalEstPercent = totalEst === '' ? '' : formatValueColumnFiled(null, totalEst/10)
            let totalEstSum = totalEst === '' ? '' : formatValueColumnFiled(null,totalEst + totalEst/10)
            $('.total-estimated-price .total-price').text(formatValueColumnFiled(null, totalEst))
            $('.total-estimated-price .percent-price').text(totalEstPercent)
            $('.total-estimated-price .sum-price').text(totalEstSum)

        }

        function listIdProductHad() {
            let ids = [];
            $('.estimate-items-tbody tr').each(function () {
                if (!isNaN($(this).data('id'))) {
                    ids.push(Number($(this).data('id')))
                }
            })
            return ids
        }

        /* get data form table product "見積り項目作成" */
        function getDataFormTableProduct() {
            let dataProducts = {}
            dataProducts['supplier_id'] = $('#supplier_id_hidden').val()
            try {
                let productsSystem = []
                let productsHandmade = []

                $('.estimate-items-tbody tr').each(function () {
                    /* Products add from modal show product */
                    if ($(this).data('id') !== undefined) {
                        productsSystem.push({
                            product_id:  $(this).data('id'),
                            supplier_amount_id: $(this).data('supplier-amount-id')
                        })
                    }
                    /* Products add handmade*/
                    else {
                        let productHandmade = {}
                        $(this).children().each(function () {
                            if ($(this).data('filed') !== 'remove') {
                                productHandmade[$(this).data('filed')] = $(this).children().text()
                            }
                        })
                        if (Object.keys(productHandmade).length > 0) {
                            /*For updates */
                            if ($(this).data('project-product-id') !== undefined) {
                                productHandmade['project_product_id'] = $(this).data('project-product-id')
                            }
                            productsHandmade.push(productHandmade)
                        }
                    }
                })
                if (productsSystem.length > 0) {
                    dataProducts['id_products_system'] = productsSystem
                }
                if (productsHandmade.length > 0) {
                    dataProducts['products_handmade'] = productsHandmade
                }
                return dataProducts
            } catch (error) {
                console.log(error)
                return dataProducts
            }
        }

        /* Search project */
        $(document).on('keyup', '#sreach_project', function () {
            let keywords = $(this).val().replace(/^\s+/gm, '')
            ajaxShowModalProject(type, {keywords: keywords})
        })

        $(document).on('keyup', '#sreach_product', function () {
            let keywords = $(this).val().replace(/^\s+/gm, '')
            ajaxShowModalProduct({key: keywords})
        })


        /* change supplier when popup list product show */
        $(document).on('change', '#supplies-select', function () {
            let supplier = $(this).val()
            ajaxShowModalProduct({supplier_id: supplier})
            removeRowTableEst(null, supplier)
            calculateTotalAll()
        })

        /* get data multiple text memo (button "テキスト追加") */
        function getMultipleDataMemoEstProduct() {
            let editableParagraphs = $('.editable-text div[contenteditable="true"]');
            let contentArray = [];

            editableParagraphs.each(function () {
                let content = $(this).html();
                let id = $(this).data('id')
                contentArray.push({
                    content: content,
                    id: id
                });
            });
            return contentArray
        }

        /* get 1 data text memo (button "テキスト追加") */
        function getDataMemoEstProduct() {
            return $('.editable-text div[contenteditable="true"]').html()
        }

        /* get 1 data shipping fees (button "送料追加") */
        function getDataShippingFees() {
            let name = $('.name-shipping-fee div[contenteditable="true"]').html()
            let fees = $('.price-shipping-fee div[contenteditable="true"]').html()
            return {
                name: name,
                fees: fees
            }
        }

    });
</script>
