<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'roles';
    protected $fillable = [
        'name'
    ];

    public function accounts()
    {
        return $this->hasMany(AccountProject::class, 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function projectRolePermissions()
    {
        return $this->hasMany(ProjectRolePermission::class);
    }

    public function accountProjects()
    {
        return $this->hasMany(AccountProject::class, 'account_id');
    }
}
