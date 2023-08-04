<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'avatar',
        'token',
        'is_admin',
        'status',
        'deleted_at',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'account_project')
            ->withPivot('project_id', 'status','account_id');
    }

    public function accProject()
    {
        return $this->hasMany(AccountProject::class);
    }

    public function accountProjectsAccess()
    {
        return $this->hasMany(AccountProject::class, 'account_id');
    }

    public function accountProjects()
    {
        return $this->belongsToMany(Project::class, 'account_project', 'account_id', 'project_id');
    }

    public function accountProject()
    {
        return $this->belongsToMany(Project::class, 'account_project')
            ->withPivot('status');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'account_project', 'account_id', 'project_id')
            ->withPivot('role_id');
    }

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'created_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'created_by');
    }

    public function hasPermission($permissionSlug, $projectSlug)
    {
        // Retrieve the project based on the slug
        $project = Project::where('slug', $projectSlug)->first();

        if (!$project) {
            // Project not found
            return false;
        }

        // Check if the user is assigned to the project
        $assignedProject = $this->projects()->where('project_id', $project->id)->first();

        if (!$assignedProject) {
            // User is not assigned to the project
            return false;
        }

        // Retrieve the role of the user within the project
        $role = Role::find($assignedProject->pivot->role_id);

        if (!$role) {
            // Role not found
            return false;
        }

        // Check if the role has the required permission
        return $role->permissions()->where('slug', $permissionSlug)->exists();
    }

    // public function hasPermission($permission)
    // {
    //     return $this->roles
    //         ->pluck('permissions')              // Get the permissions associated with each role
    //         ->flatten()                         // Flatten the collection of permissions
    //         ->pluck('slug')                     // Get the slugs of the permissions
    //         ->contains($permission);            // Check if the given permission slug exists
    // }
}
