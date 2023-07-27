<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'projects';
    protected $fillable = [
        'name',
        'project_status',
        'slug',
        'start_date',
        'end_date',
        'description',
        'token',
        'created_at',
        'deleted_at',
    ];

    // public function accountProject()
    // {
    //     return $this->belongsToMany(User::class, 'account_project')
    //         ->withPivot('status');
    // }
    public function findAccountInProjectWithStatus($status)
    {
        return $this->belongsToMany(User::class, 'account_project', 'project_id', 'account_id')
                    ->wherePivot('status', $status);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'project_role_permission')
            ->withPivot('permission_id');
    }

    public function findAccountWithRoleNameAndStatus($roleName, $status)
    {
        return $this->belongsToMany(User::class, 'account_project', 'project_id', 'account_id')
            ->wherePivot('role_id', function ($query) use ($roleName) {
                $query->from('roles')
                    ->where('name', $roleName)
                    ->select('id');
            })
            ->wherePivot('status', $status)
            ->withPivot('status');
    }


    public function accounts()
    {
        return $this->belongsToMany(User::class, 'account_project', 'project_id', 'account_id')
            ->withPivot('role_id');
    }

    public function projectRolePermissions()
    {
        return $this->hasMany(ProjectRolePermission::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function boards()
    {
        return $this->hasMany(Board::class);
    }
}
