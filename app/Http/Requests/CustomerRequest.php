<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'code' => 'required|unique:customers,code,'. $this->id.'|digits:5|not_in:00000|numeric',
            'name' => 'required',
            'email' => 'nullable|email|regex:/^[^@]+@[^\.]+\..+$/i|unique:customers,email,'. $this->id,
            'postcode-first' => 'nullable|numeric|digits:3',
            'postcode-last' => 'nullable|numeric|digits:4',
            'managers.*.name_managers' => 'required',
            'managers.*.email_managers' => 'required|email|regex:/^[^@]+@[^\.]+\..+$/i',
            'managers.*.phone_managers' => 'required',
            'managers.*.person_in_charge_id' => 'required|integer',
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
            'code.required' => 'コードは必須です。',
            'code.digits' => '暗証番号は5桁でお願いします。',
            'code.not_in' => '選択されたコードは無効です。',
            'name.required' => '名前は必須です。',
            'email.nullable' => 'メールアドレスは有効な形式である必要があります。',
            'email.email' => '正しい電子メール形式を入力する必要があります',
            'email.regex' => 'メールアドレスは有効な形式である必要があります。',
            'email.unique' => 'そのメールアドレスはすでに使用されています。',
            'postcode-first.nullable' => '郵便番号の最初の部分は3桁の数値である必要があります。',
            'postcode-first.numeric' => '郵便番号の最初の部分は3桁の数値である必要があります。',
            'postcode-first.digits' => '郵便番号の最初の部分は3桁の数値である必要があります。',
            'postcode-last.nullable' => '郵便番号の後半部分は4桁の数値である必要があります。',
            'postcode-last.numeric' => '郵便番号の後半部分は4桁の数値である必要があります。',
            'postcode-last.digits' => '郵便番号の後半部分は4桁の数値である必要があります。',
            'managers.*.name_managers.required' => 'マネージャーの名前は必須です。',
            'managers.*.email_managers.required' => 'マネージャーのメールアドレスは必須です。',
            'managers.*.email_managers.email' => 'マネージャーのメールアドレスは有効な形式である必要があります。',
            'managers.*.email_managers.regex' => 'マネージャーのメールアドレスは有効な形式である必要があります。',
            'managers.*.phone_managers.required' => 'マネージャーの電話番号は必須です。',
            'managers.*.person_in_charge_id.required' => '担当者IDは必須です。',
            'managers.*.person_in_charge_id.integer' => '担当者IDは整数である必要があります。',
        ];
    }
}
