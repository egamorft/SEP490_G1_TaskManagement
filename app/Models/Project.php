<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table ='projects';
    protected $fillable = [
        'name',
        'project_type',
        'project_status',
        'start_date',
        'end_date',
        'description',
        'created_at',
        'deleted_at',
    ];

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_project');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
