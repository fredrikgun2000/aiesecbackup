<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
    
class Members extends Model
{
    use SoftDeletes;
    protected $table = 'members';
    protected $fillable=[
        'sender_id',
        'role_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'birthdate',
        'join_period',
        'photo',
        'publish',
    ];
    protected $dates = ['deleted_at'];
}
