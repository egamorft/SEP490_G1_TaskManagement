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
        'name',
        'task_id',
        'image',
        'description',
        'assign_to',
        'review_by',
        'created_by',
        'attachment',
        'start_date',
        'due_date',
        'created_at',
        'deleted_at',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'sub_task_id');
    }

    public static $DEFAULT_ASSIGNEE = 0;

    public static int $STATUS_TODO = 1;
    public static int $STATUS_DOING = 10;
    public static int $STATUS_REVIEWING = 50;
    public static int $STATUS_DONE_ONTIME = 100;
    public static int $STATUS_DONE_LATE = -1;
    public static int $STATUS_OVERDUE = -10;
}
