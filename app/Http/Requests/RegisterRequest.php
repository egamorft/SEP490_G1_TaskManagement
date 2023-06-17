<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $rules = [
            'register-fullname' => 'required|max:50',
            'register-password' => 'required|min:6|max:50|regex:/^(?=.*[A-Z])(?=.*[\W])/',
            'register-confirm-password' => 'required|same:register-password',
            'register-email' => 'required|email|max:100|unique:accounts,email',
        ];
        return $rules;
    }
}
