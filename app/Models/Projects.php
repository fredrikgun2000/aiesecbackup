<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{
    use SoftDeletes;
    protected $table = 'projects';
    protected $fillable= [
        'banner',
        'title',
        'destination_id',
        'agency',
        'city',
        'typeofproject',
        'sdgs',
        'description',
        'benefit',
        'working_hour',
        'accomodation',
        'start_date',
        'end_date',
        'publish',
    ];
    protected $dates = ['deleted_at'];
}
