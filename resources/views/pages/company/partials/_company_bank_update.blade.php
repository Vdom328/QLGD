<div class="col-12 pt-3 pb-3 data_account_type company-bank">
    <div class="col-12 bg-light rounded p-3 mb-3 option_close">
        <div class="col-12 d-flex justify-content-end ">
            <button type="button" class="btn-close"></button>
        </div>
        {{--  --}}
        <div class="row col-12 d-flex align-items-center flex-wrap mt-2">
            <div class="col-xl-3 col-12 text-xl-end">銀行名</div>
            <div class="col-xl-9 col-12">
                <input type="text" class="form-control" name="bank_name">
            </div>
        </div>
        <div class="row col-12 d-flex align-items-center flex-wrap">
            <div class="col-xl-3 col-12 text-xl-end"></div>
            <div class="col-xl-9 col-12">
                <p id="bank_name.{{ $totalCompanyBank }}" class="w-100 error">{{ $errors->first('bank_name.*') }}</p>
            </div>
        </div>
        {{--  --}}
        <div class="row col-12 d-flex align-items-center flex-wrap">
            <div class="col-xl-3 col-12 text-xl-end">支店名</div>
            <div class="col-xl-9 col-12">
                <input type="text" class="form-control" name="branch_name">
            </div>
        </div>
        <div class="row col-12 d-flex align-items-center flex-wrap">
            <div class="col-xl-3 col-12 text-xl-end"></div>
            <div class="col-xl-9 col-12">
                <p id="branch_name.{{ $totalCompanyBank }}" class="w-100 error">{{ $errors->first('branch_name.*') }}</p>
            </div>
        </div>
        {{--  --}}
        <div class="row col-12 d-flex align-items-center flex-wrap">
            <div class="col-xl-3 col-12 text-xl-end">口座種別</div>
            <div class="col-xl-9 col-12 d-flex">
                <input type="radio" name="account_type[{{ $totalCompanyBank }}]" value="1" checked
                    id="account_type{{ $totalCompanyBank }}"><label for="account_type{{ $totalCompanyBank }}" class="ms-1 me-4">普通</label>
                <input type="radio" name="account_type[{{ $totalCompanyBank }}]" value="2"
                    id="account_type2{{ $totalCompanyBank }}"><label for="account_type2{{ $totalCompanyBank }}" class="ms-1 me-4">当座</label>
            </div>
        </div>
        <div class="row d-flex flex-wrap align-items-center ">
            <div class="col-md-2 col-12 text-md-end"></div>
            <div class="row col-md-10 col-12 d-flex align-items-center">
                <p id="account_type.{{ $totalCompanyBank }}" class="w-100 error">{{ $errors->first('account_type.*') }}</p>
            </div>
        </div>
        {{--  --}}
        <div class="row col-12 d-flex align-items-center flex-wrap">
            <div class="col-xl-3 col-12 text-xl-end">口座番号</div>
            <div class="col-xl-9 col-12">
                <input type="text" class="form-control" name="account_number">
            </div>
        </div>
        <div class="row col-12 d-flex align-items-center flex-wrap">
            <div class="col-xl-3 col-12 text-xl-end"></div>
            <div class="col-xl-9 col-12">
                <p id="account_number.{{ $totalCompanyBank }}" class="w-100 error">{{ $errors->first('account_number.*') }}</p>
            </div>
        </div>
        {{--  --}}
        <div class="row col-12 d-flex align-items-center flex-wrap">
            <div class="col-xl-3 col-12 text-xl-end">口座名義</div>
            <div class="col-xl-9 col-12">
                <input type="text" class="form-control" name="account_holder">
            </div>
        </div>
        <div class="row col-12 d-flex align-items-center flex-wrap">
            <div class="col-xl-3 col-12 text-xl-end"></div>
            <div class="col-xl-9 col-12">
                <p id="account_holder.{{ $totalCompanyBank }}" class="w-100 error">{{ $errors->first('account_holder.*') }}</p>
            </div>
        </div>
    </div>
</div>

