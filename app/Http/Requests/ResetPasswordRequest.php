<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ResetPasswordRequest extends FormRequest
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
            'reset-password-new' => [
                'required',
                'min:8',
                'max:50',
                'regex:/^(?=.*[A-Z])(?=.*[\W])/'
            ],
            'reset-password-confirm' => [
                'required',
                'min:8',
                'same:reset-password-new'
            ],
        ];
    }
}
