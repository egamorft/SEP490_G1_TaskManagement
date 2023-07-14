<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tasks';
    protected $fillable = [
        'taskList_id',
        'title',
        'due_date',
        'created_by',
        'assign_to',
        'status',
        'attachments',
        'description',
        'created_at',
        'deleted_at'
    ];

    // Define the relationships
    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class, 'task_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id', 'id');
    }
}
