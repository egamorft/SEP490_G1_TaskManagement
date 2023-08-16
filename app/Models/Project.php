<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function tasksPerProject()
    {
        return $this->hasManyThrough(Task::class, Board::class, 'project_id', 'board_id');
    }

    public function taskLists()
    {
        return $this->hasManyThrough(TaskList::class, Board::class, 'project_id', 'board_id');
    }
    
    // public function accountProject()
    // {
    //     return $this->belongsToMany(User::class, 'account_project')
    //         ->withPivot('status');
    // }

    public function userCurrentRole()
    {
        // Get the current user.

        // Get the account project record for the current user and the project.
        $account_project = AccountProject::where('project_id', $this->id)
            ->where('account_id', Auth::id())
            ->first();
        // If the account project record exists, get the role ID from it.
        if ($account_project) {
            $role_id = $account_project->role_id;
        } else {
            // If the account project record does not exist, the user does not have a role in the project.
            $role_id = null;
        }

        // Get the role name from the role ID.
        return Role::find($role_id)->name;
    }

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
        return $this->hasMany(Board::class, 'project_id', 'id');
    }
}
