<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRolePermission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'project_role_permission';
    protected $fillable = [
        'project_id',
        'role_id',
        'permission_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
