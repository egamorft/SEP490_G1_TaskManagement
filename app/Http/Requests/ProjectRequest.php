<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'modalAddProjectName' => 'required|max:50',
            'modalAddPM' => 'nullable',
            'modalAddSupervisor' => 'required',
            'modalAddMembers' => 'required|array',
            'modalAddMembers.*' => 'required',
            'duration' => 'required|regex:/\d{4}-\d{2}-\d{2} to \d{4}-\d{2}-\d{2}/'
        ];
    }
}
