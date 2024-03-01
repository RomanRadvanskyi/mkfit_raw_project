<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'memberships';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'membership_type',
        'quantity',
        'created_at',
        'status',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
