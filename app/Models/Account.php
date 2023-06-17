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
        return $this->hasMany(Comment::class, 'create_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'create_by');
    }
}
