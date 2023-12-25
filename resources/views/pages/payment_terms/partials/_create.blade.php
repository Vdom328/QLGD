{{--  --}}
<div class="col-12">
    <div class=" row col-12 d-flex flex-wrap align-items-center">
        <div class="col-xl-1 col-md-2 col-12 text-md-end pe-4">名称 </div>
        <div class="col-xl-4 col-md-6 col-12">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
    </div>
</div>
<div class="col-12">
    <div class="row col-12 d-flex flex-wrap align-items-center">
        <div class="col-xl-1 col-md-2 col-12 text-md-end pe-4"> </div>
        <div class="col-xl-4 col-md-6 col-12">
            <p class="w-100 error" >{{ $errors->first('name') }}</p>
        </div>
    </div>
</div>
{{--  --}}
<div class="col-12">
    <div class="row col-12 d-flex flex-wrap align-items-center">
        <div class="col-xl-1 col-md-2 col-12 mb-md-0 mb-2 text-md-end pe-4">基準 </div>
        <div class="col-xl-2 col-md-3 col-12  mb-md-0 mb-2">
            <select name="standard_type" id="standard_type" class="form-select">
                @for ($i = 1; $i < 10; $i++)
                    <option value="{{ $i }}" @if (old('standard_type') == $i) selected @endif>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-xl-1 col-md-3 col-12 mb-md-0 mb-2">
            <input type="number" class="form-control" name="standard_value" value="{{ old('standard_value') }}">
        </div>
        <div class="col-xl-2 col-md-3 col-12 mb-md-0 mb-2">
            <select name="standard_unit" id="standard_unit" name="standard_unit" class="form-select">
                @for ($j = 1; $j < 10; $j++)
                    <option value="{{ $j }}" @if (old('standard_unit') == $j) selected @endif>{{ $j }} 週間</option>
                @endfor
            </select>
        </div>
    </div>
</div>

<div class="col-12 mb-4">
    <div class="row col-12 d-flex flex-wrap align-items-center">
        <div class="col-xl-1 col-md-2 col-12 text-md-end pe-4"> </div>
        <div class="col-xl-4 col-md-6 col-12">
            <p class="w-100 error" >{{ $errors->first('standard_type') }}</p>
            <p class="w-100 error" >{{ $errors->first('standard_value') }}</p>
            <p class="w-100 error" >{{ $errors->first('standard_unit') }}</p>
        </div>
    </div>
</div>
