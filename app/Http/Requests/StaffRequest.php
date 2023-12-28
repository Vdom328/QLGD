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
            'first_name.required' => 'Vui lòng nhập tên của bạn.',
            'last_name.required' => 'Vui lòng nhập họ của bạn.',
            'email.required' => 'Địa chỉ email là bắt buộc.',
            'email.email' => 'Vui lòng nhập đúng định dạng địa chỉ email.',
            'email.regex' => 'Vui lòng nhập đúng định dạng địa chỉ email.',
            'email.unique' => 'Địa chỉ email này đã tồn tại.',
            'role.required' => 'Vai trò là bắt buộc.',

            'avatar.image' => 'Vui lòng chọn một tập tin ảnh.',
            'avatar.max' => 'Kích thước tập tin ảnh tối đa là 2048 kilobytes.',

            'staff_no.required' => 'Số nhân viên là bắt buộc.',
            'staff_no.unique' => 'Số nhân viên này đã tồn tại.',
            'staff_no.numeric' => 'Số nhân viên phải được nhập bằng số.',
            'staff_no.digits' => 'Số nhân viên phải có 4 chữ số.',

            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.numeric' => 'Vui lòng nhập một số điện thoại hợp lệ.',

            'password.required' => 'Trường mật khẩu là bắt buộc',

        ];
    }
}
