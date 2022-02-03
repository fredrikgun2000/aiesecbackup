<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destinations extends Model
{
    use SoftDeletes;
    protected $table = 'destinations';
    protected $fillable= [
        'country_name',
        'description',
        'status',
        'publish',
    ];
    protected $dates = ['deleted_at'];
}
