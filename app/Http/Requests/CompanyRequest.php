<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required',
            'post_code_first' => 'nullable|numeric|digits:3',
            'post_code_last' => 'nullable|numeric|digits:4',
            'logo' => 'image',
            'email' => 'nullable|email|regex:/^[^@]+@[^\.]+\..+$/i',
            'bank_name.*' => 'required',
            'branch_name.*' => 'required',
            'account_number.*' => 'required|numeric',
            'account_holder.*' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '名前は必須です。',
            'post_code_first.numeric' => '郵便番号の最初の部分は数字で入力してください。',
            'post_code_first.digits' => '郵便番号の最初の部分は3桁の数字で入力してください。',
            'post_code_last.numeric' => '郵便番号の最後の部分は数字で入力してください。',
            'post_code_last.digits' => '郵便番号の最後の部分は4桁の数字で入力してください。',
            'logo.image' => 'ロゴは画像ファイルである必要があります。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'email.regex' => '有効なメールアドレス形式で入力してください。',
            'bank_name.*.required' => '銀行名は必須です。',
            'branch_name.*.required' => '支店名は必須です。',
            'account_number.*.required' => '口座番号は必須です。',
            'account_number.*.numeric' => '口座番号は数字でなければなりません。',
            'account_holder.*.required' => '口座名義は必須です。',
        ];
    }
}
