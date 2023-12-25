<?php

namespace App\Http\Requests;

use App\Classes\Enum\StatusPaymentTermEnum;
use App\Classes\Enum\TypePaymentTermEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentTermRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => 'required',
            "standard_type" => 'required',
            "standard_value" => 'required|numeric',
            "standard_unit" => 'required|string',
            "type" => ['required', Rule::in([TypePaymentTermEnum::customer, TypePaymentTermEnum::supplier])],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => '名前フィールドは必須です。',
            'standard_type.required' => 'スタンダードタイプフィールドは必須です。',
            'standard_value.required' => 'スタンダード値フィールドは必須です。',
            'standard_value.numeric' => 'スタンダード値は数値である必要があります。',
            'standard_unit.required' => 'スタンダード単位フィールドは必須です。',
            'standard_unit.string' => 'スタンダード単位は文字列である必要があります。',
            'type.required' => 'タイプフィールドは必須です。',
            'type.in' => 'タイプフィールドには無効な値が選択されています。',
        ];
    }
}
