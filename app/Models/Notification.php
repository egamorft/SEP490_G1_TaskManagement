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
        'object_type',
        'status',
        'sender_id',
        'follower',
        'object_id',
        'description',
        'created_at',
    ];
}
