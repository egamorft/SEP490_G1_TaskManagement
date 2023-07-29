<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'socials';
    protected $fillable = [
        'provider_user_id',
        'provider',
        'account_id',
    ];

    public function account()
    {
        return $this->belongsTo(User::class);
    }
}
