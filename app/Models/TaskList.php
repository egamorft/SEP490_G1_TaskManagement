<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'taskLists';
    protected $fillable = [
        'title',
        'board_id',
        'created_at',
        'deleted_at',
    ];

    // Define the relationships
    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'taskList_id', 'id');
    }
}
