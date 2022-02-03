<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infosessionforms extends Model
{
    use SoftDeletes;
    protected $table = 'infosessionforms';
    protected $fillable= [
        'program_id',
        'datetime',
        'banner',
        'title',
        'description',
        'section_id',
        'type',
        'publish',
    ];
    protected $dates = ['deleted_at'];
}
