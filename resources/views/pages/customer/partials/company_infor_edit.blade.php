<form
method="post" action="{{ route('customer.saveEdit',$customer->id) }}"
class="row d-flex pt-3 pb-3 flex-wrap bg-white shadow-sm rounded"
    id="company_information">
    @csrf
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-xl-5 col-12 ">
            <div class="row col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-5 col-12 text-xl-end"> 取引先コード </div>
                <div class="col-5">
                    <input type="text" class="form-control code" name="" value="{{ old('code',$customer->code ?? '') }}" disabled>
                    <input type="hidden" name="code" value="{{ old('code',$customer->code ?? '') }}">
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-5 col-12 text-xl-end"></div>
                <div class="row col-xl-7 col-12 d-flex align-items-center">
                    <p class="w-100 error" id="error_code">{{ $errors->first('code') }}</p>
                </div>
            </div>
        </div>

        <div class=" col-xl-7 col-12 p-xl-0">
            <div class="row col-12 d-flex align-items-center">
                <div class="col-xl-4 col-12 text-xl-end"> インボイス番号 </div>
                <div class="col-xl-8 col-12 d-flex p-xl-0">
                    <input type="text" class="form-control" name="invoice_number"
                        value="{{ old('invoice_number',$customer->invoice_number ?? '') }}">
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-4 col-12 text-xl-end"></div>
                <div class="row col-xl-8 col-12 p-xl-0 d-flex align-items-center">
                    <p class="w-100 error" id="error_invoice_number">{{ $errors->first('invoice_number') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-12 pe-0">
            <div class="row col-12 d-flex flex-wrap align-items-center p-0">
                <div class="col-xl-2 col-12 text-xl-end"> 取引先名 </div>
                <div class="col-xl-10 col-12 pe-0"><input type="text" class="form-control" name="name"
                        value="{{ old('name',$customer->name ?? '') }}"></div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-2 col-12 text-xl-end"></div>
                <div class="row col-xl-10 col-12 d-flex align-items-center">
                    <p class="w-100 error" id="error_name">{{ $errors->first('name') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap ">
        <div class="col-xl-5 col-12 ">
            <div class="row col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-5 col-12 text-xl-end"> 郵便番号 </div>
                <div class="col-3"><input type="text" class="form-control" name="postcode-first" id="postcode-first"
                        value="{{ old('postcode-first',  $customer->postcode_first) }}"></div>
                <div class="col-1 text-center">~</div>
                <div class="col-3"><input type="text" class="form-control" name="postcode-last" id="postcode-last"
                        value="{{ old('postcode-last',  $customer->postcode_last) }}"></div>
            </div>
            <div class="row col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-5 col-12 text-xl-end">  </div>
                <div class="col-xl-7 col-12 "><p class="error"id="error_postcode-first"></p><div  class="error" id="error_postcode-last"></div></div>
            </div>
        </div>
        <div class=" col-xl-7 col-12 p-xl-0">
            <div class="row col-12 d-flex align-items-center">
                <div class="col-xl-4 col-12 text-xl-end"> 都道府県 </div>
                <div class="col-xl-8 col-12 d-flex p-xl-0">
                    <select name="prefecture_id" class="form-select">
                        <option  value="">選択してください</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" @if ($customer->prefecture_id == $province->id) selected @endif
                                {{ old('prefecture_id') == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-4 col-12 text-xl-end"></div>
                <div class="row col-xl-8 col-12 p-xl-0 d-flex align-items-center">
                    <p class="w-100 error" id="error_prefecture_id">{{ $errors->first('prefecture_id') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-12 pe-0">
            <div class="row col-12 d-flex flex-wrap align-items-center p-0">
                <div class="col-xl-2 col-12 text-xl-end"> 住所 </div>
                <div class="col-xl-10 col-12 pe-0"><input type="text" class="form-control" name="address"
                        value="{{ old('address',$customer->address ?? '') }}"></div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-2 col-12 text-xl-end"></div>
                <div class="row col-xl-10 col-12 d-flex align-items-center">
                    <p class="w-100 error" id="error_address">{{ $errors->first('address') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-12 pe-0">
            <div class="row col-12 d-flex flex-wrap align-items-center p-0">
                <div class="col-xl-2 col-12 text-xl-end"> 建物名 </div>
                <div class="col-xl-10 col-12 pe-0"><input type="text" class="form-control" name="building_name"
                        value="{{ old('building_name',$customer->building_name ?? '') }}"></div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-2 col-12 text-xl-end"></div>
                <div class="row col-xl-10 col-12 d-flex align-items-center">
                    <p class="w-100 error" id="error_building_name">{{ $errors->first('building_name') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-xl-5 col-12 ">
            <div class="row col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-5 col-12 text-xl-end"> 電話番号 </div>
                <div class="col-xl-7 col-12"><input type="text" class="form-control number" name="phone"
                        value="{{ old('phone',$customer->phone ?? '') }}"></div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-5 col-12 text-xl-end"></div>
                <div class="row col-xl-8 col-12 d-flex align-items-center">
                    <p class="w-100 error" id="error_phone">{{ $errors->first('phone') }}</p>
                </div>
            </div>
        </div>

        <div class=" col-xl-7 col-12 p-xl-0">
            <div class="row col-12 d-flex align-items-center">
                <div class="col-xl-4 col-12 text-xl-end"> FAX番号 </div>
                <div class="col-xl-8 col-12 d-flex p-xl-0"> <input type="text" class="form-control number"
                        name="fax" value="{{ old('fax',$customer->fax ?? '') }}"></div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-4 col-12 text-xl-end"></div>
                <div class="row col-xl-8 col-12 p-xl-0 d-flex align-items-center">
                    <p class="w-100 error" id="error_fax">{{ $errors->first('fax') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-xl-5 col-12 ">
            <div class="row col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-5 col-12 text-xl-end"> メールアドレス </div>
                <div class="col-xl-7 col-12"><input type="text" class="form-control" name="email"
                        value="{{ old('email',$customer->email ?? '') }}" ></div>
            </div>
            <div class="row col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-5 col-12 text-xl-end">  </div>
                <div class="col-xl-7 col-12">
                    <p class="w-100 error" id="error_email">{{ $errors->first('email') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-xl-5 col-12 ">
            <div class="row col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-5 col-12 text-xl-end"> 支払い条件 </div>
                <div class="col-xl-7 col-12 d-flex align-items-center">
                    <select id="" class="form-select" name="payment_terms" >
                        <option  value="">選択してください</option>
                        @foreach ( $paymentTerms as $paymentTerm)
                            <option value="{{ $paymentTerm->id }}" @if ($customer->payment_terms == $paymentTerm->id) selected @endif {{ old('payment_terms') == $paymentTerm->id ? 'selected' : '' }}>{{ $paymentTerm->name }}</option>
                        @endforeach
                    </select>
                    {{-- <div class=" ps-2"><button type="button" class="btn_add d-flex align-items-center">+</button></div> --}}
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-5 col-12 text-xl-end"></div>
                <div class="row col-xl-8 col-12 d-flex align-items-center">
                    <p class="w-100 error" id="error_payment_terms">{{ $errors->first('payment_terms') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-xl-5 col-12 ">
            <div class="row col-12 d-flex flex-wrap align-items-center">
                <div class="col-xl-5 col-12 text-xl-end"> 与信枠 </div>
                <div class="col-xl-7 col-12"> <input type="text" class="form-control" name="credit_limit"
                        value="{{ old('credit_limit',$customer->credit_limit ?? '') }}"></div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-5 col-12 text-xl-end"></div>
                <div class="row col-xl-8 col-12 d-flex align-items-center">
                    <p class="w-100 error" id="error_credit_limit">{{ $errors->first('credit_limit') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="row col-xl-11 col-12  flex-wrap align-items-center">
        <div class="col-12 pe-0">
            <div class="row col-12 d-flex flex-wrap  p-0">
                <div class="col-xl-2 col-12 text-xl-end"> メモ </div>
                <div class="col-xl-10 col-12 pe-0">
                    <textarea name="memo" id="" rows="3" class="form-control">{{ old('memo',$customer->memo ?? '') }}</textarea>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center ">
                <div class="col-xl-2 col-12 text-xl-end"></div>
                <div class="row col-xl-10 col-12 d-flex align-items-center">
                    <p class="w-100 error" id="error_memo">{{ $errors->first('memo') }}</p>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}

    {{-- custommer --}}
    <div class="col-12 d-flex flex-wrap justify-content-center mt-5">
        <div class="col-xl-11 col-12  p-3 bg-light rounded ">
            <div class="customer_table_container">
                <table class="col-12 customer_table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>取引先担当者名</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th>社内担当</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="body_table_manager">
                        @for ($i = 0; $i < count($customer->customer_managers); $i++)
                            @php
                                $customer_managers = $customer->customer_managers[$i];
                            @endphp
                            <tr class="form_manager" id="managers[{{ $i }}]">
                                <th style="min-width: 100px" class="text-end pe-4">担当者</th>
                                <td class="p-0">
                                    <input name="managers[{{ $i }}][id]" type="hidden" value="{{ $customer_managers->id }}">
                                    <input name="managers[{{ $i }}][name_managers]" type="text" value="{{ $customer_managers->name }}">
                                </td>
                                <td class="p-0">
                                    <input name="managers[{{ $i }}][email_managers]" type="text" value="{{ $customer_managers->email }}">
                                </td>
                                <td class="p-0">
                                    <input name="managers[{{ $i }}][phone_managers]" type="tel" value="{{ $customer_managers->phone }}" class="number">
                                </td>
                                <td class="p-0">
                                    <select name="managers[{{ $i }}][person_in_charge_id]" class="form-select border-0 select_staff">
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}" @if ($customer_managers->person_in_charge_id == $staff->id) selected @endif @if ($staff->profile->avatar)data-image="{{ asset('storage/avatarUser/' . $staff->profile->avatar) }}" @else data-image="{{ Avatar::create(Auth::user()->name)->toBase64() }}" @endif >
                                                {{ $staff->profile->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <th class="d-flex align-items-center justify-content-end pt-2">
                                    @if ( count($customer->customer_managers) > 1)
                                        <button type="button" class="btn_remove d-flex align-items-center remove_customer_manager">-</button>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <p class="w-100 error" id="error_{{ $i }}_name_managers"></p>
                                </th>
                                <th>
                                    <p class="w-100 error" id="error_{{ $i }}_email_managers"></p>
                                </th>
                                <th>
                                    <p class="w-100 error" id="error_{{ $i }}_phone_managers"></p>
                                </th>
                                <th>
                                    <p class="w-100 error" id="error_{{ $i }}_person_in_charge_id"></p>
                                </th>
                                <th></th>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-end mt-2"><button type="button"
                    class="btn_add d-flex align-items-center" id="add_customer_manager">+</button></div>

        </div>
        <div class="col-12 d-flex flex-wrap mt-5">
            <div class="col-xl-2 col-12 ps-md-5">
                <x-button type="button" id="btn-del" class="btn-danger btn-block" :text="trans('common.btn.delete')" attrs="data-bs-toggle=modal data-bs-target=#confirmDelete"
                dataTitle="{{trans('顧客の削除')}}" dataMessage="{{trans('この顧客を削除しますか?')}}"/>
            </div>
            <div class="col-xl-10 col-12 d-flex justify-content-center">
                <div class="col-md-5 col-4 d-flex align-items-center justify-content-end  pe-4 ps-5">
                    <a href="{{ route('customer.index') }}" class="btn-dark-dark ">戻　る</a>
                </div>
                <div class="col-md-7 col-4 ps-4 d-flex align-items-center">
                    <button type="submit" class="btn-dark-dark">保　存</button>
                </div>
            </div>
        </div>
    </div>
</form>
