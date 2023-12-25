<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|regex:/^[^@]+@[^\.]+\..+$/i|unique:users,email,' . $this->id,
            'role' => 'required',
            'avatar' => 'nullable|image|max:2048',
            'staff_no' => ['required', 'numeric', 'digits:4', Rule::unique('profiles')->ignore($this->id, 'user_id')],
            'kana_first_name' => 'required|regex:/^[ア-ンｧ-ﾝﾞﾟー]*$/u',
            'kana_last_name' => 'required|regex:/^[ア-ンｧ-ﾝﾞﾟー]*$/u',
            'phone' => 'required|numeric',
            'password' => 'required'
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
            'first_name.required' => 'お名前を入力してください。',
            'last_name.required' => '姓を入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.regex' => '正しいメールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスは既に存在しています。',
            'role.required' => 'ロールは必須です。',

            'avatar.image' => '画像ファイルを選択してください。',
            'avatar.max' => '画像ファイルサイズは最大2048キロバイトまでです。',

            'staff_no.required' => 'スタッフ番号は必須です。',
            'staff_no.unique' => 'このスタッフ番号は既に存在しています。',
            'staff_no.numeric' => 'スタッフ番号は数字で入力してください。',
            'staff_no.digits' => 'スタッフ番号は4桁で入力してください。',

            'kana_first_name.required' => 'カナ姓は必須です。',
            'kana_first_name.regex' => 'カナ姓は全角カタカナで入力してください。',

            'kana_last_name.required' => 'カナ名は必須です。',
            'kana_last_name.regex' => 'カナ名は全角カタカナで入力してください。',

            'phone.required' => '電話番号は必須です。',
            'phone.numeric' => '有効な電話番号を入力してください。',

            'password.required' => 'パスワードフィールドは必須です',
        ];
    }
}
