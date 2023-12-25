<ul class="nav nav-pills mb-3 col-12 p-5 pb-2 " id="pills-tab" role="tablist">
    <li class="d-flex  justify-content-center col" role="presentation">
        <button class="nav-link custom_button justify-content-center active" id="redemption_letter_tab" data-bs-toggle="pill" data-bs-target="#redemption_letter"
            type="button" role="tab" aria-controls="redemption_letter" aria-selected="true">見積書</button>
    </li>
    <li class="d-flex  justify-content-center col" role="presentation">
        <button class="nav-link custom_button justify-content-center" id="note_book_tab" data-bs-toggle="pill" data-bs-target="#note_book"
            type="button" role="tab" aria-controls="note_book" aria-selected="false">発注書</button>
    </li>
    <li class="d-flex  justify-content-center col" role="presentation">
        <button class="nav-link custom_button justify-content-center" id="customer_letter_tab" data-bs-toggle="pill" data-bs-target="#customer_letter"
            type="button" role="tab" aria-controls="customer_letter" aria-selected="false">顧客請求書</button>
    </li>
    <li class="d-flex  justify-content-center col" role="presentation">
        <button class="nav-link custom_button justify-content-center" id="request_letter_tab" data-bs-toggle="pill" data-bs-target="#request_letter"
            type="button" role="tab" aria-controls="request_letter" aria-selected="false">T→E 請求書</button>
    </li>
    <li class="d-flex  justify-content-center col" role="presentation">
        <button class="nav-link custom_button justify-content-center" id="to_do_tab" data-bs-toggle="pill" data-bs-target="#to_do"
            type="button" role="tab" aria-controls="to_do" aria-selected="false">To Do</button>
    </li>
</ul>
<div class="tab-content col-12" id="pills-tabContent">
    {{-- redemption_letter table --}}
    <div class="tab-pane fade show active" id="redemption_letter" role="tabpanel" aria-labelledby="redemption_letter_tab">
        {{-- <div class="col-12 mt-4 flex-wrap d-flex align-items-center">
            <div class="text-md-end col-2 col-lg-1 fw-bold">受注日</div>
            <div class="col-12 col-md-3 col-lg-3 ps-2">
                <input type="date" class="form-control" id="" name="">
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 d-flex align-items-center">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
                <button type="button" class="btn-dark-dark">現在の情報で見積もり作成</button>
            </div>
        </div> --}}
        @include('pages.project.partials._table_nav')
        <div class="col-12 d-flex align-items-center justify-content-center pb-4">
            <button type="button" class="btn-dark-dark col-2">現在の情報で見積もり作成
            </button>
        </div>
    </div>
    {{-- end  redemption_letter--}}
    {{-- note book tab --}}
    <div class="tab-pane fade" id="note_book" role="tabpanel" aria-labelledby="note_book_tab">
        <div class="col-12 mt-4 flex-wrap d-flex align-items-center">
            <div class="text-md-end col-2 col-lg-1 fw-bold">受注日</div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 ps-2 d-flex align-items-center" >
                <input type="date" class="form-control" id="" name="">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 ps-2 d-flex align-items-center">
                <input type="date" class="form-control" id="" name="">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 d-flex align-items-center">
                <button type="button" class="btn-dark-dark">現在の情報で見積もり作成</button>
            </div>
        </div>
        @include('pages.project.partials._table_nav')
    </div>
    {{-- end note book tab --}}
    {{-- customer_letter book tab --}}
    <div class="tab-pane fade" id="customer_letter" role="tabpanel" aria-labelledby="customer_letter_tab">
        <div class="col-12 mt-4 flex-wrap d-flex align-items-center">
            <div class="text-md-end col-2 col-lg-1 fw-bold">受注日</div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 ps-2 d-flex align-items-center" >
                <input type="date" class="form-control" id="" name="">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 ps-2 d-flex align-items-center">
                <input type="date" class="form-control" id="" name="">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 d-flex align-items-center">
                <button type="button" class="btn-dark-dark">現在の情報で見積もり作成</button>
            </div>
        </div>
        @include('pages.project.partials._table_nav')
    </div>
    {{-- end customer_letter tab --}}
    {{-- request_letter book tab --}}
    <div class="tab-pane fade" id="request_letter" role="tabpanel" aria-labelledby="request_letter_tab">
        <div class="col-12 mt-4 flex-wrap d-flex align-items-center">
            <div class="text-md-end col-2 col-lg-1 fw-bold">受注日</div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 ps-2 d-flex align-items-center" >
                <input type="date" class="form-control" id="" name="">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 ps-2 d-flex align-items-center">
                <input type="date" class="form-control" id="" name="">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 d-flex align-items-center">
                <button type="button" class="btn-dark-dark">現在の情報で見積もり作成</button>
            </div>
        </div>
        @include('pages.project.partials._table_nav')
    </div>
    {{-- end request_letter tab --}}
    {{-- to_do book tab --}}
    <div class="tab-pane fade" id="to_do" role="tabpanel" aria-labelledby="to_do_tab">
        <div class="col-12 mt-4 flex-wrap d-flex align-items-center">
            <div class="text-md-end col-2 col-lg-1 fw-bold">受注日</div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 ps-2 d-flex align-items-center" >
                <input type="date" class="form-control" id="" name="">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 ps-2 d-flex align-items-center">
                <input type="date" class="form-control" id="" name="">
                <label><i class="far fa-calendar-alt mx-4"></i></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 mt-md-0 mt-3 d-flex align-items-center">
                <button type="button" class="btn-dark-dark">現在の情報で見積もり作成</button>
            </div>
        </div>
        @include('pages.project.partials._table_nav')
    </div>
    {{-- end todo tab --}}
</div>
