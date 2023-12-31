<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'slug'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    public function projectRolePermissions()
    {
        return $this->hasMany(ProjectRolePermission::class, 'permission_id');
    }
}
