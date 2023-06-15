<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'social';
    protected $fillable = ['provider_user_id', 'provider', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
