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
            'email.required' => 'Địa chỉ email là bắt buộc.',
            'email.email' => 'Vui lòng nhập đúng định dạng địa chỉ email.',
            'email.regex' => 'Vui lòng nhập đúng định dạng địa chỉ email.',
            'email.unique' => 'Địa chỉ email này đã tồn tại.',
            'role.required' => 'Vai trò là bắt buộc.',

            'avatar.image' => 'Vui lòng chọn một tập tin ảnh.',
            'avatar.max' => 'Kích thước tập tin ảnh tối đa là 2048 kilobytes.',

            // 'staff_no.required' => 'スタッフ番号は必須です。',
            // 'staff_no.unique' => 'このスタッフ番号は既に存在しています。',



            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.numeric' => 'Vui lòng nhập một số điện thoại hợp lệ.',
        ];
    }
}
