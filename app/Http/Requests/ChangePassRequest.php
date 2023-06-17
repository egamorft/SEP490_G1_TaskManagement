<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePassRequest extends FormRequest
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
            'oldPassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Auth::attempt(['email' => $this->user()->email, 'password' => $value])) {
                        $fail('Wrong old password!!');
                    }
                },
            ],
            'newPassword' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[\W])/',
                function ($attribute, $value, $fail) {
                    if ($value === $this->input('oldPassword')) {
                        $fail('New password must different from old password!!');
                    }
                },
            ],
        ];
    }
}
