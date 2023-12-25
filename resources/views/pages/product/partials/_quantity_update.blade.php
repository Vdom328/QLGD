<style>
    input[readonly] {
        background-color: #e9ecef !important;
        cursor: not-allowed !important;
    }
</style>
<div class="col-12 p-3 bg-light rounded mt-4 data-quantity">
    <div class="col-12 d-flex flex-wrap">
        <div class="col-md-6 col-8 d-flex align-items-center">
            <div class="col-2 text-end pe-2 pb-3">数量</div>
            <div class="col-2">
                <input readonly type="text" class="form-control" name="quantity"
                    value="{{ old('quantity', $quantity != null ? $quantity->quantity : '') }}">
                <p class="w-100 error error_quantity"></p>
            </div>
            <div class="col-2 ps-2 pb-3">~</div>
        </div>
        <div class="col-md-6 col-4 d-flex justify-content-end">
            <button type="button" class="btn_product d-flex align-items-center me-2 edit-quantity"><i class="fa-solid fa-pen" style="color: #fafafa;"></i></button>
            <button type="button" class="btn_product d-flex align-items-center close-quantity"><i class="fa-regular fa-trash-can" style="color: #fafafa; "></i></button>
        </div>
    </div>
    <div class="col-12 p-4">
        <div class="customer_table_container">
            <table class="col-12 customer_table">
                <thead>
                    <tr>
                        <th style="width:5%"></th>
                        <th>仕入れ先</th>
                        <th>単価</th>
                        <th>標準販売価格</th>
                        <th>最低数量</th>
                        <th>メモ</th>
                    </tr>
                </thead>
                <tbody id="body_table_manager" class="body_table_manager">
                    @foreach ($quantity->supplierAmount as $supplier)
                        <tr class="supplier_item">
                            <td class="text-center p-0">
                                <div class="form-switch">
                                    <input readonly class="form-check-input"
                                        @if ($supplier->status == 1) checked @endif type="checkbox"
                                        id="switchInput" name="status" value="1">
                                </div>
                            </td>
                            <td>
                                <input readonly type="hidden" name="supplier_id" value="{{ $supplier->supplier_id }}">
                                <a href="" class="">{{ $supplier->supplier->name }}</a>
                            </td>
                            <td class="p-0">
                                <input readonly type="number" name="price"
                                    value="{{ old('price', $supplier != null ? $supplier->price : '') }}">
                                <div class="border-top">
                                    <p class="ps-3 m-0 w-100 error error_price"></p>
                                </div>
                            </td>
                            <td class="p-0">
                                <input readonly type="number" name="selling_price"
                                    value="{{ old('selling_price', $supplier != null ? $supplier->selling_price : '') }}">
                                <div class="border-top">
                                    <p class="ps-3 m-0 w-100 error error_selling_price"></p>
                                </div>
                            </td>
                            <td class="p-0">
                                <input readonly type="number" name="min_quantity"
                                    value="{{ old('min_quantity', $supplier != null ? $supplier->min_quantity : '') }}">
                                <div class="border-top">
                                    <p class="ps-3 m-0 w-100 error error_min_quantity"></p>
                                </div>
                            </td>
                            <td class="p-0">
                                <input readonly type="text" name="memo"
                                    value="{{ old('memo', $supplier != null ? $supplier->memo : '') }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
