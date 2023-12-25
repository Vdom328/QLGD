@extends('layouts.app')

@section('template_linked_css')
    @vite(['resources/css/company/create_company.css'])
@endsection

@section('page_icon')
<img src="{{ asset('assets/images/icons/view-week.png') }}" class="menu_icon icon-bxs-dashboard menu_icon_top" />
@endsection

@section('page_title')
    自社情報設定
@endsection
@section('title-page')
    自社情報設定
@endsection

@section('page_title_actions')
    <div>＞自社情報設定＞自社情報登録</div>
@endsection

@section('content')
    <form id="form-company" class="row bg-white rounded col-12  pt-3 pb-3 shadow-sm" method="POST"
        action="{{ route('company.create.save') }}" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex flex-wrap  ln_company position-relative">
            <div class="col-md-6 col-12 ps-xl-5 pe-xl-5 ps-3 pe-3 infor_company">
                <div class="col-12 text-center pt-1 pb-1 bg-dark text-white mb-4">
                    企業情報
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap pt-3">
                    <div class="col-xl-3 col-12 text-xl-end">会社名</div>
                    <div class="col-xl-9 col-12">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end"></div>
                    <div class="col-xl-9 col-12">
                        <p id="name" class="w-100 error">{{ $errors->first('name') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">インボイス番号</div>
                    <div class="col-xl-9 col-12">
                        <input type="text" class="form-control" name="invoice_number"
                            value="{{ old('invoice_number') }}">
                    </div>
                </div>
                <div class="row d-flex flex-wrap align-items-center ">
                    <div class="col-md-2 col-12 text-md-end"></div>
                    <div class="row col-md-10 col-12 d-flex align-items-center">
                        <p id="invoice_number" class="w-100 error">{{ $errors->first('invoice_number') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">郵便番号</div>
                    <div class="col-xl-9 col-12 d-flex align-items-center">
                        <div class="col-xl-3 col-5"> <input type="number" min="0" step="1"
                                id="post-code-first" oninput="validity.valid||(value='');" class="form-control"
                                name="post_code_first" value="{{ old('post_code_first') }}"></div>
                        <div class="col-1 text-center">~</div>
                        <div class="col-xl-4 col-6"><input type="number" min="0" step="1" id="post-code-last"
                                oninput="validity.valid||(value='');" class="form-control" name="post_code_last"
                                value="{{ old('post_code_last') }}"></div>
                    </div>
                </div>
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end"></div>
                    <div class="col-xl-9 col-12">
                        <p id="post_code_first" class="w-100 error">{{ $errors->first('post_code_first') }}</p>
                    </div>
                </div>
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end"></div>
                    <div class="col-xl-9 col-12">
                        <p id="post_code_last" class="w-100 error">{{ $errors->first('post_code_last') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">都道府県</div>
                    <div class="col-xl-9 col-12 d-flex align-items-center">
                        <div class="col-xl-8 col-12 me-2">
                            <select name="prefecture_id" class="form-select">
                                <option value="">選択してください</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}"
                                        {{ old('prefecture_id') == $province->id ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row d-flex flex-wrap align-items-center ">
                    <div class="col-md-2 col-12 text-md-end"></div>
                    <div class="row col-md-10 col-12 d-flex align-items-center">
                        <p id="prefecture_id" class="w-100 error">{{ $errors->first('prefecture_id') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">住所</div>
                    <div class="col-xl-9 col-12">
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                    </div>
                </div>
                <div class="row d-flex flex-wrap align-items-center ">
                    <div class="col-md-2 col-12 text-md-end"></div>
                    <div class="row col-md-10 col-12 d-flex align-items-center">
                        <p id="address" class="w-100 error">{{ $errors->first('address') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">建物名</div>
                    <div class="col-xl-9 col-12">
                        <input type="text" class="form-control" name="building_name" value="{{ old('building_name') }}">
                    </div>
                </div>
                <div class="row d-flex flex-wrap align-items-center ">
                    <div class="col-md-2 col-12 text-md-end"></div>
                    <div class="row col-md-10 col-12 d-flex align-items-center">
                        <p id="building_name" class="w-100 error">{{ $errors->first('building_name') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">電話番号</div>
                    <div class="col-xl-9 col-12">
                        <input type="text" class="form-control" step="1" name="phone" value="{{ old('phone') }}" min="0" oninput="validity.valid||(value='');">
                    </div>
                </div>
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end"></div>
                    <div class="col-xl-9 col-12">
                        <p id="phone" class="w-100 error">{{ $errors->first('phone') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">メールアドレス</div>
                    <div class="col-xl-9 col-12">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end"></div>
                    <div class="col-xl-9 col-12">
                        <p id="email" class="w-100 error">{{ $errors->first('email') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">決算時期</div>
                    <div class="col-xl-9 col-12 d-flex align-items-center">
                        <div class="col-xl-8 col-12 me-2">
                            <select name="closing_date" class="form-select">
                                <option value="">選択してください</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{$i}}" {{ old('closing_date') == $i ? 'selected' : '' }}>{{$i}}月</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row d-flex flex-wrap align-items-center ">
                    <div class="col-md-2 col-12 text-md-end"></div>
                    <div class="row col-md-10 col-12 d-flex align-items-center">
                        <p id="closing_date" class="w-100 error">{{ $errors->first('closing_date') }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end">ロゴ</div>
                    <div class="col-xl-7 col-12 d-flex align-items-center">
                        <div class="col-5">
                            <button type="button" class="btn-grey button-image">選　択</button>
                        </div>
                        <div id="containerImage" style="max-width: 100px;max-height: 100px;"></div>
                    </div>
                    <input accept="image/png, image/gif, image/jpeg" type="file" name="logo" id="inputImage"
                        hidden>
                </div>
                <div class="row col-12 d-flex align-items-center flex-wrap">
                    <div class="col-xl-3 col-12 text-xl-end"></div>
                    <div class="col-xl-9 col-12">
                        <p id="logo" class="w-100 error">{{ $errors->first('logo') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 ps-xl-5 pe-xl-5 ps-3 pe-3">
                <div class="col-12 text-center pt-1 pb-1 bg-dark text-white mb-4">
                    口座情報
                </div>
                {{--  --}}
                @include('pages.company.partials._company_bank')
                <div class="add-company-bank">
                </div>
                <div class="col-12 d-flex justify-content-end  pt-3">
                    <button type="button" class="btn_add d-flex align-items-center justify-content-center" id="add_account_type" data-sizebankvirtual="1"><p class="pt-3">+</p></button>
                </div>
            </div>
        </div>
        <div class="row col-12 d-flex">
            <div class="col-md-6 col-4 text-end">
                <button type="button" class="btn-dark-dark">
                    <a style="color: #FFF" href="{{ route('company.index') }}">戻　る</a>
                </button>
            </div>
            <div class="col-md-6 col-4">
                <button type="submit" class="btn-dark-dark">保　存</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
            $('#add_account_type').on('click', function() {
                var totalCompanyBank = $('.total_company_bank').val();
                var sizeBankVirtual = parseInt($(this).attr('data-sizebankvirtual'));
                sizeBankVirtual = sizeBankVirtual + 1;
                $.ajax({
                    type: "GET",
                    url: "{{ route('company.render') }}",
                    data: {
                        total_company_bank: totalCompanyBank,
                        index: sizeBankVirtual,
                        id: null
                    },
                    success: function(data) {
                        $('.add-company-bank').append(data.resultcontainer);
                        $('#add_account_type').attr('data-sizebankvirtual', sizeBankVirtual);
                    }
                });
            })

            //submit form
            $('#form-company').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                var banks = [];
                $('div.company-bank').each(function(i, obj) {
                    banks.push($(this).find('input').serializeArray());
                });
                formData.append('banks', JSON.stringify(banks));

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
                            window.location.href = "{{ route('company.index') }}";
                        } else {
                            $(".error").html("");
                            if (response.errors) {
                                $.each(response.errors, function(fieldName, errorMessages) {
                                    var fieldId = fieldName.replace('.', '\\.');
                                    var errorHtml = '';
                                    $.each(errorMessages, function(index, errorMessage) {
                                        errorHtml += errorMessage;
                                    });
                                    errorHtml;
                                    $('#' + fieldId).html(errorHtml);
                                    $('#' + fieldId).show();
                                });
                            }

                            if (response.bank_errors) {
                                // set message error to input of bank
                                $('div.company-bank').each(function(i, obj) {
                                    $.each(response.bank_errors, function(fieldName, errorMessages) {
                                        var errors = fieldName.split(".");
                                        var indexBank = parseInt(errors[0]);
                                        var nameInput = errors[1];
                                        if (i == indexBank) {
                                            var errorHtml = '';
                                            $.each(errorMessages, function(index, errorMessage) {
                                                errorHtml += errorMessage;
                                            });

                                            var elInput = $($('div.company-bank')[i]);
                                            var idElMsg = $(elInput).find('.error_'+nameInput);
                                            $(idElMsg).html(errorHtml);
                                            $(idElMsg).show();
                                        } else {
                                            $(idElMsg).html("");
                                            $(idElMsg).hide();
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

            //Delet row Specific Open-time table
            $(document).on('click', '.data_account_type .btn-close', function() {
                $(this).closest('.company-bank').remove();
            });

            $('.button-image').click(function() {
                $('#inputImage').click();
            });

            $('#containerImage').click(function() {
                $('#inputImage').click();
            });

            $('#inputImage').change(function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgSrc = e.target.result;
                    var img = $('<img>').attr('src', imgSrc).css({
                        'width': '100%',
                        'height': '100%',
                    });
                    img.on('load', function() {
                        $('#containerImage').addClass('col-3');
                        $('#containerImage').empty().append(img);
                    });
                };
                reader.readAsDataURL(file);
            });

            $('#post-code-first').on('input', function() {
                if ($(this).val().length > 3) {
                    $(this).val($(this).val().slice(0, 3));
                }
            });

            $('#post-code-last').on('input', function() {
                if ($(this).val().length > 4) {
                    $(this).val($(this).val().slice(0, 4));
                }
            });
        });
    </script>
@endsection
