<div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm mt-3">
    <div class="d-flex flex-wrap wrap_data_chart justify-content-center">
        <div class="col-xl-3 col-md-6 col-12 d-flex justify-content-center border-r">
            <div class="">エンブルー受注残 </div>
            <div class="ps-5">12,345,678円</div>
        </div>
        <div class="col-xl-3 col-md-6 col-12 d-flex justify-content-center">
            <div class="">TERAS受注残</div>
            <div class="ps-5">12,345,678円</div>
        </div>
    </div>
</div>

{{--  --}}
<div class="row d-flex pt-3 pb-3 flex-wrap bg-white rounded shadow-sm mt-3">
    <div class=" col-12 d-flex text-center mb-4 ps-xl-5 pe-xl-5 pt-3">
        <div class="col-3 ps-xl-3 pe-xl-3">
            <a href="{{ route('analyze.sales.index') }}" class="col-12 p-2  rounded-pill cursor-pointer btn-white {{ (strpos(Route::currentRouteName(), 'analyze.sales.index') === 0) ? 'active' : '' }}">企業情報</a>
        </div>
        <div class="col-3 ps-xl-3 pe-xl-3">
            <a href="{{ route('analyze.order.index') }}" class="col-12 p-2  rounded-pill cursor-pointer btn-white {{ (strpos(Route::currentRouteName(), 'analyze.order.index') === 0) ? 'active' : '' }}">企業情報</a>
        </div>
        <div class="col-3 ps-xl-3 pe-xl-3">
            <a href="{{ route('analyze.gross-profit-total.index') }}" class="col-12 p-2  rounded-pill cursor-pointer btn-white {{ (strpos(Route::currentRouteName(), 'analyze.gross-profit-total.index') === 0) ? 'active' : '' }}">企業情報</a>
        </div>
        <div class="col-3 ps-xl-3 pe-xl-3">
            <a href="{{ route('analyze.gross-profit-margin.index') }}" class="col-12 p-2  rounded-pill cursor-pointer btn-white {{ (strpos(Route::currentRouteName(), 'analyze.gross-profit-margin.index') === 0) ? 'active' : '' }}">企業情報</a>
        </div>
    </div>

    <div class="mt-5 mb-5">
        <div class="text-center">売上合計</div>
        <div class="d-flex flex-wrap wrap_data_chart justify-content-center mt-3">
            <div class="col-xl-3 col-md-6 col-12 d-flex justify-content-center fw-bold border-r">
                <div class="">昨年 </div>
                <div class="ps-5">12,345,678円</div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 d-flex justify-content-center fw-bold">
                <div class="">今年</div>
                <div class="ps-5">12,345,678円</div>
            </div>
        </div>
    </div>
    {{-- char js --}}
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <div class="col-12 p-5">
        <div class="col-12" style="border-bottom: 1px solid"></div>
    </div>

    {{-- table --}}

    <div class="col-12 d-flex justify-content-end pe-5">
        <button type="button" class="btn-dark-dark">CSV出力</button>
    </div>
    <div class="col-12 pe-5 ps-5 mt-4">
        <div class="row p-3 customer_table_container">
            <table class="table table-hover text-center">
                <thead>
                    <tr class="text-center">
                        <th></th>
                        <th>売上額</th>
                        <th>発注合計</th>
                        <th>粗利合計</th>
                        <th>粗利率</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10; $i++)
                        <tr>
                            <td>2023年1月</td>
                            <td>12,234,566</td>
                            <td>6,234,566 </td>
                            <td>6,234,566</td>
                            <td>49.0</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

</div>
