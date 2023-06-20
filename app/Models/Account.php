<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Account extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;
    public $timestamps = false;
    protected $table = 'accounts';
    protected $fillable = [
        'fullname',
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
        return $this->belongsToMany(Role::class, 'account_role');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'account_project');
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

    public function hasAnyPermission($permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    public function hasPermission($permission)
    {
        return $this->roles
            ->pluck('permissions')              // Get the permissions associated with each role
            ->flatten()                         // Flatten the collection of permissions
            ->pluck('slug')                     // Get the slugs of the permissions
            ->contains($permission);            // Check if the given permission slug exists
    }
}
