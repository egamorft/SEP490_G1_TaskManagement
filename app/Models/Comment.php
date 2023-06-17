<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'comments';
    protected $fillable = [
        'sub_task_id',
        'content',
        'visible',
        'created_by',
        'updated_at',
    ];

    public function subTask()
    {
        return $this->belongsTo(SubTask::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(Account::class, 'created_by');
    }
}
