<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'reports';
    protected $fillable = [
        'created_by',
        'reason',
        'reported',
        'image',
        'status',
        'response',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function reportedAccount()
    {
        return $this->belongsTo(User::class, 'reported');
    }
}
