<table class="table table-hover ">
    <thead>
    <tr>
        <th class="sort_table">
            取引先コード
        </th>
        <th class="sort_table">取引先</th>
        <th class="sort_table">取引先担当者</th>
    </tr>
    </thead>
    <tbody id="customer_table">
    @foreach ($customersManager as $customerManager)
        <tr class="cursor-pointer customer-selected"
            @if($customerManager->customer)
                data-id="{{ $customerManager->customer->id }}"
            data-name="{{ $customerManager->customer->name }}"
            data-address="{{ $customerManager->customer->address}}"
            @endif
            data-id-manager="{{ $customerManager->id }}"
            data-name-manager="{{ $customerManager->name }}"
        >
            <td>{{ $customerManager->id }}</td>
            <td>{{ $customerManager->customer ? $customerManager->customer->name : ''  }}</td>
            <td>{{ $customerManager->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
