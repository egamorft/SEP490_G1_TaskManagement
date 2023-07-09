<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'subTasks';
    protected $fillable = [
        'task_id',
        'title',
        'assign_to',
        'due_date',
        'status',
        'created_at',
        'deleted_at'
    ];

    // Define the relationships
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function assignee()
    {
        return $this->belongsTo(Account::class, 'assign_to', 'id');
    }
}
