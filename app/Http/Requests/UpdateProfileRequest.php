<?php

namespace App\Http\Requests;

use App\Models\Profile;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        // $user = Profile::where('user_id',$this->input('id'))->first();

        return [
            'email' => 'required|email|regex:/^[^@]+@[^\.]+\..+$/i|unique:users,email,' . $this->id,
            'role' => 'required',
            // 'avatar' => 'nullable|image|max:2048',
            // 'staff_no' => 'required|unique:profiles,staff_no,' . $this->id,
            'phone' => 'required|numeric',
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
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.regex' => '正しいメールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスは既に存在しています。',
            'role.required' => 'ロールは必須です。',

            'avatar.image' => '画像ファイルを選択してください。',
            'avatar.max' => '画像ファイルサイズは最大2048キロバイトまでです。',

            // 'staff_no.required' => 'スタッフ番号は必須です。',
            // 'staff_no.unique' => 'このスタッフ番号は既に存在しています。',

            

            'phone.required' => '電話番号は必須です。',
            'phone.numeric' => '有効な電話番号を入力してください。',
        ];
    }
}
