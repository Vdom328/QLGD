<div class="data-keyword">
    <div class="col-12 d-flex align-items-center">
        <div class="col-11">
            <input type="text" class="form-control" name="keyword" value="{{ old('keyword', $keyWord != null ? $keyWord->keyword: '') }}">
        </div>
        <div class="ms-3 d-flex align-items-center justify-content-center pe-3">
            @if ($index > 0)
                <button type="button" class="btn_close close-keyword">-</button>
            @endif
        </div>
    </div>
    <div class="row d-flex flex-wrap">
        <div class="row col-xl-10 col-12 d-flex align-items-center">
            <p class="w-100 error error_keyword "></p>
        </div>
    </div>
</div>
