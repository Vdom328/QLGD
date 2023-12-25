<tr class="form_manager" id="managers[{{ $managersCount }}]">
    <th style="min-width: 100px" class="text-end pe-4">担当者</th>
    <td class="p-0">
        <input name="managers[{{ $managersCount }}][id]" type="hidden">
        <input name="managers[{{ $managersCount }}][name_managers]" type="text" >
    </td>
    <td class="p-0">
        <input name="managers[{{ $managersCount }}][email_managers]" type="text" >
    </td>
    <td class="p-0">
        <input name="managers[{{ $managersCount }}][phone_managers]" type="text" class="number">
    </td>
    <td class="p-0">
        <select name="managers[{{ $managersCount }}][person_in_charge_id]" class="form-select border-0 select_staff">
            @foreach ($staffs as $staff)
                <option value="{{ $staff->id }}" @if ($staff->profile->avatar)data-image="{{ asset('storage/avatarUser/' . $staff->profile->avatar) }}" @else data-image="{{ Avatar::create($staff->profile->fullname)->toBase64() }}" @endif >
                    {{ $staff->profile->fullname }}
                </option>
            @endforeach
        </select>
    </td>
    <th class="d-flex align-items-center justify-content-end pt-2">
        <button type="button" class="btn_remove d-flex align-items-center remove_customer_manager">-</button>
    </th>
</tr>
<tr>
    <th></th>
    <th>
        <p class="w-100 error" id="error_{{ $managersCount }}_name_managers"></p>
    </th>
    <th>
        <p class="w-100 error" id="error_{{ $managersCount }}_email_managers"></p>
    </th>
    <th>
        <p class="w-100 error" id="error_{{ $managersCount }}_phone_managers"></p>
    </th>
    <th>
        <p class="w-100 error" id="error_{{ $managersCount }}_person_in_charge_id"></p>
    </th>
    <th></th>
</tr>
