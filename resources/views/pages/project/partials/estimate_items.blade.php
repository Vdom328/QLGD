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
                    @if(!empty($categorySelect) && \App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom($categorySelect->name))
                        <table
                            class="table table-borderless mt-3 project-table border-bottom-solid-project estimate-table">
                            <thead>
                            <tr>
                                @foreach(\App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom($categorySelect->name)->filedTables() as $filedTable)
                                    <th scope="col"
                                        data-filed="{{ $filedTable['name'] }}">{{ $filedTable['text'] }}</th>
                                @endforeach
                                <th scope="col" data-filed="remove">
                                </th>
                            </tr>
                            </thead>
                            <tbody class="estimate-items-tbody">

                            @if(!empty($project) && $project->category_id === $categorySelect->id && $project->projectProducts->count() > 0)
                                @foreach($project->projectProducts as $projectProduct)
                                    {{-- Product Handmade --}}
                                    @if(empty($projectProduct->est_product_id))
                                        <tr data-project-product-id="{{ $projectProduct->id }}">
                                            @foreach(\App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom($categorySelect->name)->filedTables() as $key => $filedTable)
                                                <td data-filed="{{ $filedTable['name'] }}" class="est-product-{{ $filedTable['name'] }}">
                                                    <div @if(!in_array($filedTable['name'], ['total', 'supplier'])) class="border-contenteditable" contenteditable="true" @endif>
                                                        {{ \App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom($categorySelect->name)->getValueInFiledByProjectProductsHandMade($projectProduct, $filedTable['name']) }}
                                                    </div>
                                                </td>
                                            @endforeach
                                            <td data-filed="remove">
                                                <div class="d-flex justify-content-end">
                                                    <div style="position: unset !important;"
                                                         class="circular-button remove-product-row">x
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        {{-- Product System --}}
                                        <tr data-id="{{ $projectProduct->est_product_id }}"
                                            data-supplier-amount-id="{{ $projectProduct->supplier_amount_id }}"
                                            data-project-product-id="{{ $projectProduct->id }}">
                                            @foreach(\App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom($categorySelect->name)->filedTables() as $filedTable)
                                                <td data-filed="{{ $filedTable['name'] }}">
                                                    {{ \App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom($categorySelect->name)->getValueInFiledByProjectProductsSystem($projectProduct, $filedTable['name']) }}
                                                </td>
                                            @endforeach
                                            <td data-filed="remove">
                                                <div class="d-flex justify-content-end">
                                                    <div style="position: unset !important;"
                                                         class="circular-button remove-product-row">x
                                                    </div>
                                                </div>
                                            </td>
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
                <div class="group-editable-text">
                    @if(!empty($project) && $project->projectProductMemos->count() > 0)
                        @foreach($project->projectProductMemos->sortBy('no') as $projectProductMemo)
                            <div class="border-bottom-solid-project editable-text d-flex mb-3">
                                <div contenteditable="true" class="mb-3" @if(empty(request('copyProjectId'))) data-id="{{ $projectProductMemo->id }}" @endif>
                                    {!!  html_entity_decode($projectProductMemo->memo) !!}
                                </div>
                                <div class="circular-button remove-editable-text">X</div>
                            </div>
                        @endforeach
                    @endif
                </div>
                {{-- End editable-text --}}

                {{-- Additional shipping fees --}}
                <div class="add-shipping-fees">
                    @if(!empty($project) && $project->projectProductShippingFees->count() > 0)
                        @foreach($project->projectProductShippingFees as $shippingFees)
                            <div class="border-bottom-solid-project mb-3 d-flex">
                                <div class="col-7 name-shipping-fee">
                                    <div class="mb-3" contenteditable="true">{!! html_entity_decode($shippingFees->name) !!}</div>
                                </div>
                                <div class="col-4 price-shipping-fee">
                                    <div class="mb-3" contenteditable="true">{{ number_format($shippingFees->fees) }}</div>
                                </div>
                                <div class="circular-button remove-editable-text">X</div>
                            </div>
                        @endforeach
                    @endif
                </div>
                {{-- End Additional shipping fees --}}

                <div>
                    <div class="d-flex mb-4 mt-4 justify-content-between row">
                        <div class="col-12 col-lg-4">
                            <table class="table table-bordered table-style-project">
                                <tbody>
                                <tr>
                                    <th scope="row">仕入れ先</th>
                                    <td class="supplier-name">
                                        @if(!empty($project) && !empty($supplier) && $project->category_id === $categorySelect->id)
                                            {{ $supplier->name }}
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 col-lg-3">
                            <table class="table table-bordered table-style-project total-purchase-price">
                                <tbody>
                                <tr>
                                    <th scope="row">仕入れ小計</th>
                                    <td class="total-price">{{ count($calculateTotalEst) > 0 ? formatNumber($calculateTotalEst['totalPurchase']) : '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">消費税（10％）</th>
                                    <td class="percent-price">{{ count($calculateTotalEst) > 0 ? formatNumber($calculateTotalEst['totalPurchase']/10) : '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">消費税（10％）仕入れ合計</th>
                                    <td class="sum-price">{{ count($calculateTotalEst) > 0 ? formatNumber(($calculateTotalEst['totalPurchase'] + $calculateTotalEst['totalPurchase']/10)) : '' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-lg-3">
                            <table class="table table-bordered table-style-project total-estimated-price">
                                <tbody>
                                <tr>
                                    <th scope="row">見積り小計</th>
                                    <td class="total-price">{{ count($calculateTotalEst) > 0 ? formatNumber($calculateTotalEst['totalEstimated']) : '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">消費税（10％）</th>
                                    <td class="percent-price">{{ count($calculateTotalEst) > 0 ? formatNumber($calculateTotalEst['totalEstimated']/10) : '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">見積り合計</th>
                                    <td class="sum-price">{{ count($calculateTotalEst) > 0 ? formatNumber(($calculateTotalEst['totalEstimated'] + $calculateTotalEst['totalEstimated']/10)) : '' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input hidden--}}
        <div class="hide">
            <input type="text" id="supplier_name_hidden"
                   name="supplier_name_hidden"
                   @if(!empty($project) && !empty($supplier) && $project->category_id === $categorySelect->id)
                       value="{{ $supplier->name }}"
                   @endif
                   hidden disabled>
            <input type="text" id="supplier_id_hidden"
                   name="supplier_id_hidden"
                   @if(!empty($project) && !empty($supplier) && $project->category_id === $categorySelect->id)
                       value="{{ $supplier->id }}"
                   @endif
                   hidden disabled>
        </div>
        {{-- End Input hidden--}}
    </div>
</div>
<div class="d-flex justify-content-between p-5 row">
    <div class="col-12 col-lg-3">
        <table class="table table-bordered table-style-gainsboro">
            <tbody>
            <tr>
                <th scope="row">TERAS仕入れ値</th>
                <td class="text-right">8,588,800</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-12 col-lg-3">
        <table class="table table-bordered table-style-gainsboro">
            <tbody>
            <tr>
                <th scope="row">エンブルー仕入れ値</th>
                <td class="text-right">10,788,800</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-3">
        <table class="table table-bordered table-style-gainsboro">
            <tbody>
            <tr>
                <th scope="row">TERAS粗利</th>
                <td class="text-right">2,200,000</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
