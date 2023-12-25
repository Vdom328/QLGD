
@for ($i = 0; $i < count($data); $i++)
    @php
        $item = $data[$i];
    @endphp
     <tr>
        <td style="min-width: 10px" class="text-center">{{ $i + 1 }}</td>
        <td style="min-width: 200px">{{ $item->name }}</td>
        <td class="text-end">
            <a href="{{ route('payment_terms.updatePaymentTerm',$item->id) }}" class="btn-grey" id="auto-gen">編集</a>
        </td>
    </tr>
@endfor

