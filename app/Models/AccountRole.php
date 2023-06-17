<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRole extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'account_role';
    protected $fillable = [
        'account_id',
        'role_id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
