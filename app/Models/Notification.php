<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'notifications';
    protected $fillable = [
        'title',
        'seen',
        'sender_id',
        'follower',
        'target_url',
        'description',
        'created_at',
    ];
}
