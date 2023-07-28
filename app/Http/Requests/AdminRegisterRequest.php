<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user-fullname' => 'required|max:50',
            'user-password' => 'required|min:8|max:50|regex:/^(?=.*[A-Z])(?=.*[\W])/',
            'user-email' => 'required|email|max:100|unique:users,email',
        ];
    }
}
