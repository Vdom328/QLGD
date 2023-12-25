<div class="d-flex align-items-center pb-3">
    <label for="" class="me-3">仕入れ先:</label>
    <select class="form-select w-50 select2" name="" id="supplies-select">
        @foreach($supplies as $supplier)
            <option @if(!empty($supplier_id) && (int)$supplier_id == $supplier->id) selected @endif value="{{ $supplier->id }}">{{ $supplier->name }}</option>
        @endforeach
    </select>
</div>
<div class="table-responsive">
    <table class="table table-hover table table-borderless">
        <thead>
        <tr>
            <th scope="col" style="width: 30px">
                <input type="checkbox" class="cursor-pointer form-check-input check-all-products">
            </th>
            <th scope="col">型番</th>
            <th scope="col">カテゴリ</th>
            <th scope="col">商品名</th>

            <th scope="col">最安仕入れ先</th>
            <th scope="col">最安単価</th>
        </tr>
        </thead>
        <tbody id="product_table">
        @foreach ($products['products'] as $product)
            @php
                //$total = \App\Classes\Enum\ProjectEstimateItemByCategory::tryFrom('QB')->calculateTotalPriceSystem($product);
                $price = optional($product->supplierAmounts->first())->price ?? '';
                $quantity = '';
                if ($product->supplierAmounts->first()) {
                    $productQuantity = $product->supplierAmounts->first()->productQuantity;
                    $quantity = $productQuantity ? $productQuantity->quantity : $quantity;
                }
                $total = ($price !== '' && $quantity !== '') ? $price * $quantity : '';
                $checked = in_array($product->id, $idsProduct);
            @endphp
            <tr class="cursor-pointer"
                data-id="{{ $product->id }}"
                data-supplier-amount-id="{{ $product->supplierAmounts->first()->id }}"
                data-name="{{ $product->name }}"
                data-model_number="{{ $product->model_number }}"
                data-price="{{ $price }}"
                data-quantity="{{ $quantity }}"
                data-total="{{ $total }}"
                data-supplier="{{ optional($product->supplierAmounts->first())->supplier->name ?? '' }}"
            >
                <td>
                    <input type="checkbox" @if($checked) checked @endif class="cursor-pointer form-check-input check-product">
                </td>
                <td>{{ $product->model_number }}</td>
                <td>
                    {{ $product->category->name }}
                </td>
                <td><a class="text-decoration-underline"
                       href="{{ route('product.update', $product->id) }}">{{ $product->name }}
                    </a>
                </td>
                <td>{{ optional($product->supplierAmounts->first())->supplier->name ?? '' }}</td>
                <td>{{ optional($product->supplierAmounts->first())->price ?? '' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

