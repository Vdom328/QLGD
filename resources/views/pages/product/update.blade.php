@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/supplier/supplier.css'])
    @vite(['resources/css/product/style.css'])
@endsection

@section('page_icon')
    <img height="28" src="{{ asset('assets/images/icons/pencil-square.png') }}" class="menu_icon" />
@endsection

@section('page_title')
    見積もり項目設定
@endsection
@section('title-page')
    見積もり項目設定
@endsection

@section('page_title_actions')
    <div>各種項目設定 > 見積もり項目設定 > 見積もり項目詳細</div>
@endsection

@section('content')
    <style>
        .btn-add-item {
            margin-bottom: 22px !important;
        }
    </style>
    <div class=" col-12 d-flex text-center mb-4">
        <div class="col-6 pe-2">
            <div id="companyInfoTab" class="col-12 p-2 bg-white shadow-sm rounded-pill ">商品情報</div>
        </div>
        <div class="col-6 ps-2">
            <div id="projectInfoTab" class="col-12 p-2 bg-white shadow-sm rounded-pill ">価格情報</div>
        </div>
    </div>
    <form method="POST" action="{{ route('product.update.save', $product->id) }}"
        class="row d-flex pt-3 pb-3 flex-wrap bg-white shadow-sm rounded" id="form-product">
        @csrf
        {{--  --}}
        <div id="product_information">
            <div class="row col-xl-11 col-12  flex-wrap align-items-center">
                <div class="col-xl-5 col-12 ">
                    <div class="row col-12 d-flex flex-wrap align-items-center">
                        <div class="col-xl-5 col-12 text-xl-end"> 管理番号 </div>
                        <div class="col-5"><input id="control-number" type="number" class="form-control" readonly
                                name="control_number" value="{{ old('control_number', $product->control_number) }}"></div>
                    </div>
                    <div class="row d-flex flex-wrap align-items-center ">
                        <div class="col-xl-5 col-12 text-xl-end"></div>
                        <div class="row col-xl-7 col-12 d-flex align-items-center p-0">
                            <p id="control_number" class="w-100 error"></p>
                        </div>
                    </div>
                </div>

                <div class=" col-xl-5 col-12 p-xl-0">
                    <div class="row col-12 d-flex align-items-center">
                        <div class="col-xl-4 col-12 text-xl-end"> カテゴリ: </div>
                        <div class="col-xl-5 col-12 d-flex p-xl-0">
                            <select class="form-select" name="category_id">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row d-flex flex-wrap align-items-center ">
                        <div class="col-xl-4 col-12 text-xl-end"></div>
                        <div class="row col-xl-8 col-12 p-xl-0 d-flex align-items-center">
                            <p id="category_id" class="w-100 error"></p>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            <div class="row col-xl-11 col-12  flex-wrap align-items-center">
                <div class="col-12 pe-0">
                    <div class="row col-12 d-flex flex-wrap align-items-center p-0">
                        <div class="col-xl-2 col-12 text-xl-end"> 商品名 </div>
                        <div class="col-xl-10 col-12 pe-0"><input type="text" class="form-control" name="name"
                                value="{{ old('name', $product->name) }}"></div>
                    </div>
                    <div class="row d-flex flex-wrap align-items-center ">
                        <div class="col-xl-2 col-12 text-xl-end"></div>
                        <div class="row col-xl-10 col-12 d-flex align-items-center">
                            <p id="name" class="w-100 error"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-xl-11 col-12  flex-wrap align-items-center">
                <div class="col-12 pe-0">
                    <div class="row col-12 d-flex flex-wrap align-items-center p-0">
                        <div class="col-xl-2 col-12 text-xl-end"> 型式 </div>
                        <div class="col-xl-10 col-12 pe-0"><input type="text" class="form-control" name="model_number"
                                value="{{ old('model_number', $product->model_number) }}"></div>
                    </div>
                    <div class="row d-flex flex-wrap align-items-center ">
                        <div class="col-xl-2 col-12 text-xl-end"></div>
                        <div class="row col-xl-10 col-12 d-flex align-items-center">
                            <p id="model_number" class="w-100 error"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-xl-11 col-12  flex-wrap align-items-center">
                <div class="col-12 pe-0">
                    <div class="row col-12 d-flex flex-wrap  p-0">
                        <div class="col-xl-2 col-12 text-xl-end"> キーワード </div>
                        <div class="col-xl-10 col-12 pe-0 d-flex flex-wrap align-items-end data-keyword-all">
                            <div class="col-5">
                                @foreach ($product->productKeyWords as $key => $keyWord)
                                    @include('pages.product.partials.keyword', [
                                        'keyWord' => $keyWord,
                                        'index' => $loop->index,
                                    ])
                                @endforeach
                                <div id="add-keyword"></div>
                            </div>
                            <div class="btn-add-item col-1 d-flex align-content-end ms-3">
                                <div class="col-2"><button type="button" id="btn-add-keyword"
                                        style="margin-bottom: 1px !important"
                                        class="btn_add_product d-flex align-items-center">+</button>
                                    <div class="error_check_keyword"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-xl-11 col-12 flex-wrap align-items-center">
                <div class="col-12 pe-0">
                    <div class="row col-12 d-flex flex-wrap  p-0">
                        <div class="col-xl-2 col-12 text-xl-end"> 特記事項 </div>
                        <div class="col-xl-10 col-12 pe-0 d-flex flex-wrap align-items-end data-notice-all">
                            <div class="col-11">
                                @foreach ($product->productNotices as $key => $notice)
                                    @include('pages.product.partials.notice', [
                                        'notice' => $notice,
                                        'index' => $loop->index,
                                    ])
                                @endforeach
                                <div id="add-notice"></div>
                            </div>
                            <div class="btn-add-item col-1 d-flex align-content-end">
                                <div class="col-2"><button type="button" id="btn-add-notice"
                                        class="btn_add_product d-flex align-items-center">+</button>
                                    <div class="error_check_notice"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row col-xl-11 col-12  flex-wrap align-items-center">
                <div class="col-12 pe-0">
                    <div class="row col-12 d-flex flex-wrap  p-0">
                        <div class="col-xl-2 col-12 text-xl-end"> メモ </div>
                        <div class="col-xl-10 col-12 pe-0">
                            <textarea name="memo_product" id="" rows="3" class="form-control">{{ old('memo', $product->memo) }}</textarea>
                        </div>
                    </div>
                    <div class="row d-flex flex-wrap align-items-center ">
                        <div class="col-xl-2 col-12 text-xl-end"></div>
                        <div class="row col-xl-10 col-12 d-flex align-items-center">
                            <p class="w-100 error">{{ $errors->first('memo') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
        <div id="project_information">
            <div class="col-12 p-4 bg-white shadow-sm rounded-3 data-quantity-all">
                <div class="col-12 d-flex justify-content-end">
                    <a id="btn-add-quantity" type="button" data-bs-toggle="tooltip" title="新規作成"
                        data-bs-placement="bottom" class="btn-shadow ms-3 btn btn-primary btn-add-new">
                        <i class="fa fa-add"></i>
                        新規作成
                    </a>
                </div>
                <div id="add-quantity">
                    @foreach ($product->productQuantities as $key => $quantity)
                        @include('pages.product.partials._quantity_update', [
                            'suppliers' => $suppliers,
                            'quantity' => $quantity,
                        ])
                    @endforeach
                </div>
            </div>
        </div>
        {{-- custommer --}}
        <div class="col-12 d-flex mt-3 mb-3">
            <div class="col-md-6 col-4 d-flex align-items-center justify-content-between pe-4 ps-5">
                <x-button type="button" id="btn-del" class="btn-danger btn-block" :text="trans('common.btn.delete')" attrs="data-bs-toggle=modal data-bs-target=#confirmDelete"
                dataTitle="{{trans('製品の削除')}}" dataMessage="{{trans('本当に削除しますか?')}}"/>
                <a href="{{ route('product.index') }}" class="btn-dark-dark">戻　る</a>
            </div>
            <div class="col-md-6 col-4 ps-4 d-flex align-items-center">
                <button type="submit" class="btn-dark-dark">保　存</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
    @include('modals.modal-delete-form', ['url' => route('product.delete', $product->id)])
    @include('scripts.delete-modal-form-script')
    <script>
        $(document).ready(function() {
            $("#companyInfoTab").addClass("active-click");
            $("#projectInfoTab").removeClass("active-click");

            $("#project_information").addClass("d-none");
            $("#product_information").removeClass("d-none");

            // $("#project_information").removeClass("d-none");
            //     $("#product_information").addClass("d-none");
            // Handle click events
            $("#companyInfoTab").click(function() {
                $("#companyInfoTab").addClass("active-click");
                $("#projectInfoTab").removeClass("active-click");

                $("#product_information").removeClass("d-none");
                $("#project_information").addClass("d-none");
            });

            $("#projectInfoTab").click(function() {
                $("#projectInfoTab").addClass("active-click");
                $("#companyInfoTab").removeClass("active-click");

                $("#project_information").removeClass("d-none");
                $("#product_information").addClass("d-none");
            });

            $(document).on("click", "#auto-gen", function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.code') }}",
                    data: {},
                    success: function(data) {
                        $('#control-number').val(data.code);
                    },
                });
            });

            $('#btn-add-notice').on('click', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.render.notice') }}",
                    data: {
                        id: null
                    },
                    success: function(data) {
                        $('#add-notice').append(data.resultcontainer);
                    }
                });
            });

            $(document).on('click', '.data-notice .close-notice', function() {
                $(this).closest('.data-notice').remove();
            });

            $('#btn-add-keyword').on('click', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.render.keyword') }}",
                    data: {
                        id: null
                    },
                    success: function(data) {
                        $('#add-keyword').append(data.resultcontainer);
                    }
                });
            });

            $(document).on('click', '.data-keyword .close-keyword', function() {
                $(this).closest('.data-keyword').remove();
            });

            $('#btn-add-quantity').on('click', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.render.quantity') }}",
                    data: {},
                    success: function(data) {
                        $('#add-quantity').append(data.resultcontainer);
                    }
                });
            });

            $(document).on('click', '.data-quantity .close-quantity', function() {
                $(this).closest('.data-quantity').remove();
            });

            $(document).on('click', '.edit-quantity', function() {
                var form = $(this).closest(
                    '.data-quantity');

                form.find('input').removeAttr('readonly');
            });

            $('#form-product').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                var keywords = [];
                var notices = [];

                $('div.data-keyword-all').each(function(i, obj) {
                    keywords.push($(this).find('input').serializeArray());
                });
                formData.append('keywords', JSON.stringify(keywords));

                $('div.data-notice-all').each(function(i, obj) {
                    notices.push($(this).find('input').serializeArray());
                });
                formData.append('notices', JSON.stringify(notices));

                var suppliers = [];
                var amountsElTr = $("table.customer_table");
                $("input[name='quantity']").each(function(i, obj) {
                    var amounts = [];
                    var amountFirstEl = amountsElTr[i];
                    var amountEl = $(amountFirstEl).parents('.data-quantity');
                    $(amountEl).find("table tr").each(function(i1, obj1) {
                        if (i1 > 0) {
                            var inputs = $(this).find("input").serializeArray();
                            var amount = {};
                            for (let index = 0; index < inputs.length; index++) {
                                var element = inputs[index];
                                amount[element['name']] = element['value'];
                            }

                            amounts.push(amount);
                        }
                    });

                    suppliers.push({
                        'quantity': $(this).val(),
                        'amounts': amounts
                    });
                });

                formData.append('quantities', JSON.stringify(suppliers));

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.checkUpdate == false) {
                            location.reload();
                        } else if (response.checkUpdate == true) {
                            window.location.href = "{{ route('product.index') }}";
                        } else {
                            if (response.errors) {
                                $(".error").html("");
                                $.each(response.errors, function(fieldName, errorMessages) {
                                    var fieldId = fieldName.replace('.', '\\.');
                                    var errorHtml = '';
                                    $.each(errorMessages, function(index,
                                        errorMessage) {
                                        errorHtml += errorMessage;
                                    });
                                    errorHtml;
                                    $('#' + fieldId).html(errorHtml);
                                    $('#' + fieldId).show();
                                });
                            }

                            if (response.keyword_errors) {
                                $('.error_check_keyword').html(
                                    '<p style="margin-bottom: 19px;"></p>')
                                $('.error_keyword').each(function(i, obj) {
                                    var elInput = this;
                                    $.each(response.keyword_errors, function(fieldName,
                                        errorMessages) {
                                        var errors = fieldName.split(".");
                                        var indexKeyWord = parseInt(errors[0]);
                                        var nameInput = errors[1];
                                        if (i == indexKeyWord) {
                                            var errorHtml = '';
                                            $.each(errorMessages, function(
                                                index, errorMessage) {
                                                errorHtml +=
                                                    errorMessage;
                                            });
                                            $(elInput).html(errorHtml);
                                            $(elInput).show();
                                        }
                                    });
                                });
                            }

                            if (response.notice_errors) {
                                $('.error_check_notice').html(
                                    '<p style="margin-bottom: 19px;"></p>')
                                $('.error_notice').each(function(i, obj) {
                                    var elInput = this;
                                    $.each(response.notice_errors, function(fieldName,
                                        errorMessages) {
                                        var errors = fieldName.split(".");
                                        var indexNotice = parseInt(errors[0]);
                                        var nameInput = errors[1];
                                        if (i == indexNotice) {
                                            var errorHtml = '';
                                            $.each(errorMessages, function(
                                                index, errorMessage) {
                                                errorHtml +=
                                                    errorMessage;
                                            });
                                            $(elInput).html(errorHtml);
                                            $(elInput).show();
                                        }
                                    });
                                });
                            }

                            if (response.supplier_errors) {
                                $.each(response.supplier_errors, function(fieldName,
                                    errorMessages) {
                                    var errors = fieldName.split(".");
                                    var indexSupplier = parseInt(errors[0]);
                                    var nameInput = errors[1];
                                    var errorHtml = '';

                                    $.each(errorMessages, function(index,
                                    errorMessage) {
                                        errorHtml += errorMessage + '<br>';
                                    });

                                    var row = $('.body_table_manager').find(
                                        '.supplier_item').eq(indexSupplier);

                                    row.find('.error_' + nameInput).html(errorHtml);
                                });
                            }

                            if (response.quantity_errors) {
                                $('.error_quantity').each(function(i, obj) {
                                    var elInput = this;
                                    $.each(response.quantity_errors, function(fieldName,
                                        errorMessages) {
                                        var errors = fieldName.split(".");
                                        var indexQuantity = parseInt(errors[0]);
                                        var nameInput = errors[1];
                                        if (i == indexQuantity) {
                                            var errorHtml = '';
                                            $.each(errorMessages, function(
                                                index, errorMessage) {
                                                errorHtml +=
                                                    errorMessage;
                                            });
                                            $(elInput).html(errorHtml);
                                            $(elInput).show();
                                        }
                                    });
                                });
                            }
                        }
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
        });
    </script>
@endsection
