<?php

namespace App\Models;

use App\Rules\UniqueBoardTitle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'boards';
    protected $fillable = [
        'title',
        'project_id',
        'created_at',
        'deleted_at'
    ];

    // Define the relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function taskLists()
    {
        return $this->hasMany(TaskList::class, 'board_id', 'id');
    }

    public function tasks()
    {
        return $this->hasManyThrough(Task::class, TaskList::class, 'board_id', 'taskList_id');
    }
    
    public static function validationRules($projectId = null, $boardId = null)
    {
        $rules = [
            'modalBoardName' => [
                'required',
                'max:100',
                new UniqueBoardTitle($projectId)
            ],
            // Add other validation rules as needed
        ];

        if ($boardId) {
            $rules['modalBoardName'][] = 'unique:boards,title,' . $boardId;
        }

        return $rules;
    }
}
