<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubTasksRequest extends FormRequest
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
            "taskTitle" => 'required|max:50',
            "taskList" => 'required',
            "taskAssignee" => 'required',
            "taskDueDate" => 'required'
        ];
    }
}
