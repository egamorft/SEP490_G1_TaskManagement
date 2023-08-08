<?php

namespace App\Rules;

use App\Models\Board;
use Illuminate\Contracts\Validation\Rule;

class UniqueBoardTitle implements Rule
{
    protected $project_id;

    public function __construct($project_id)
    {
        $this->project_id = $project_id;
    }

    public function passes($attribute, $value)
    {
        return !Board::where('title', $value)
            ->where('project_id', $this->project_id)
            ->exists();
    }

    public function message()
    {
        return 'The board title is already taken for this project.';
    }
}
