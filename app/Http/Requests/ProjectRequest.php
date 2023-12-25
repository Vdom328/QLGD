<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /* Return json */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()]));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'no' => 'required|integer|min:1',
            'name' => 'required',
            'status' => 'required',
            'exprire_date' => 'required|date',
            'receipt_order_date' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'カテゴリー は、必ず指定してください。',
            'no.required' => '案件番号 は、必ず指定してください。',
            'no.integer' => '案件番号 整数を指定してください。',
            'no.min' => '案件番号 には、1以上の数字を指定してください。',
            'name.required' => '案件名 は、必ず指定してください。',
            'status.required' => '状況 は、必ず指定してください。',
            'exprire_date.required' => '納品日 は、必ず指定してください。',
            'exprire_date.date' => '納品日 有効期限 は、正しい日付ではありません。',
            'receipt_order_date.required' => '受注日 は、必ず指定してください。',
            'receipt_order_date.date' => '受注日 は、正しい日付ではありません。',
        ];
    }


}
