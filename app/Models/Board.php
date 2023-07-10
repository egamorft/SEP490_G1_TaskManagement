<?php

namespace App\Models;

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
        'limitation',
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
}
