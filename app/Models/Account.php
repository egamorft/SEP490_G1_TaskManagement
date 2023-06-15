<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'account';
    protected $fillable = ['username', 'fullname', 'email', 'password', 'address', 'avatar', 'token', 'is_admin', 'deleted_at'];

    public function social()
    {
        return $this->hasOne(Social::class, 'account_id');
    }
}
