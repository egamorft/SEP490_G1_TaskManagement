<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountProject extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'account_project';
    protected $fillable = [
        'project_id',
        'account_id',
        'role_id',
        'status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function account()
    {
        return $this->belongsTo(User::class, 'account_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
