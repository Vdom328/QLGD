<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            "type" => 'required',
            "title" => 'required',
            "status" => 'required',
            "expired_date" => 'required|date',
            "manager_id" => 'nullable|exists:users,id',
            "registrar_id" => 'nullable|exists:users,id',
        ];
    }
    public function messages(): array
    {
        return [
            "type.required" => 'タイプフィールドは必須です。',
            "title.required" => 'タイトルフィールドは必須です。',
            "status.required" => 'ステータスフィールドは必須です。',
            "expired_date.required" => '期限日フィールドは必須です。',
            "expired_date.date" => '有効な日付形式ではありません。',
            "manager_id.exists" => '指定されたマネージャーIDは存在しません。',
            "registrar_id.exists" => '指定された登録者IDは存在しません。',
        ];
    }
}
