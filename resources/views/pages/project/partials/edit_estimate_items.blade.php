<div class="mt-5 mb-5 p-3">
    <div class="overflow-hidden rounded-5 border-radius-20">
        <div class="text-white bg-dark">
            <div class="p-4"> 見積り項目作成</div>
        </div>
        <div class="bg-gainsboro">
            <div class="p-4">
                {{-- Button --}}
                <div class="d-flex flex-wrap">
                    <button type="button" class="btn-dark-dark me-3 mt-2 add-product-button">商品追加</button>
                    <button type="button" class="btn-dark-dark me-3 mt-2 add-product-handmade">商品手打ち追加</button>
                    <button type="button" class="btn-dark-dark me-3 mt-2 add-shipping-fees-button">送料追加</button>
                    <button type="button" class="btn-dark-dark me-3 mt-2 add-text-button">テキスト追加</button>
                </div>
                {{-- End Button --}}

                {{-- Table --}}
                <div class="table-responsive">
                    @if(\App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom('QB'))
                        <table
                            class="table table-borderless mt-3 project-table border-bottom-solid-project estimate-table">
                            <thead>
                            <tr>
                                @foreach(\App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom('QB')->filedTables() as $filedTable)
                                    <th scope="col"
                                        data-filed="{{ $filedTable['name'] }}">{{ $filedTable['text'] }}</th>
                                @endforeach
                                <th scope="col" data-filed="remove">
                                </th>
                            </tr>
                            </thead>
                            <tbody class="estimate-items-tbody">
                            @if(!empty($projects) && $projects->projectProducts->count() > 0)
                                @foreach($projects->projectProducts as $product)
                                    {{-- Product Handmade --}}
                                    @if(empty($product->est_product_id))
                                        <tr data-project-product-id="{{ $product->id }}">
                                            @foreach(\App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom('QB')->filedTables() as $filedTable)
                                                <td data-filed="{{ $filedTable['name'] }}">
                                                    <div contenteditable="true">
                                                        {{ \App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom('QB')->getValueInFiledByProjectProductsHandMade($product, $filedTable['name']) }}
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    @endif
                </div>
                {{-- End Table --}}

                {{-- editable-text --}}
                <div class="group-editable-text"></div>
                {{-- End editable-text --}}

                {{-- Additional shipping fees --}}
                <div class="add-shipping-fees"></div>
                {{-- End Additional shipping fees --}}

                <div>
                    <div class="d-flex mb-4 mt-4 justify-content-between row">
                        <div class="col-12 col-lg-4">
                            <table class="table table-bordered table-style-project">
                                <tbody>
                                <tr>
                                    <th scope="row">仕入れ先</th>
                                    <td>株式会社XXX商事</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 col-lg-3">
                            <table class="table table-bordered table-style-project">
                                <tbody>
                                <tr>
                                    <th scope="row">Họ và tên</th>
                                    <td>John Doe</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tuổi</th>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <th scope="row">Địa chỉ</th>
                                    <td>123 Main Street</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-lg-3">
                            <table class="table table-bordered table-style-project">
                                <tbody>
                                <tr>
                                    <th scope="row">Họ và tên</th>
                                    <td>John Doe</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tuổi</th>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <th scope="row">Địa chỉ</th>
                                    <td>123 Main Street</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="d-flex justify-content-between p-5 row">
    <div class="col-12 col-lg-3">
        <table class="table table-bordered table-style-gainsboro">
            <tbody>
            <tr>
                <th scope="row">Họ và tên</th>
                <td class="border-right-none text-right">John Doe</td>
            </tr>
            </tbody>
        </table>
    </div>


    <div class="col-12 col-lg-3">
        <table class="table table-bordered table-style-gainsboro">
            <tbody>
            <tr>
                <th scope="row" style="border-left: none">Họ và tên 333</th>
                <td class="text-right border-left-none">John Doe</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-3">
        <table class="table table-bordered table-style-gainsboro">
            <tbody>
            <tr>
                <th scope="row" style="border-left: none">Họ và tên</th>
                <td class="text-right">John Doe</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
