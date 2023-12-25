<div class="data-notice">
    <div class="col-12 d-flex align-items-center">
        <div style="width: calc(100% - 62px)">
            <input type="text" class="form-control" name="notice"
                value="{{ old('notice', $notice != null ? $notice->notice : '') }}">
        </div>
        <div class="ms-3 d-flex align-items-center justify-content-center pe-3">
            @if ($index > 0)
                <button type="button" class="btn_close close-notice">-</button>
            @endif
        </div>
    </div>
    <div class="row d-flex flex-wrap">
        <div class="row col-xl-10 col-12 d-flex align-items-center">
            <p class="w-100 error error_notice"></p>
        </div>
    </div>
</div>
