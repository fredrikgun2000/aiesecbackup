<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infosessionprograms extends Model
{
    use SoftDeletes;
    protected $table = 'infosessionprograms';
    protected $fillable= [
        'theme',
        'sdgs',
        'faculty',
        'poster',
        'datetime',
        'description',
        'link_meet',
        'link_content',
        'publish',
    ];
    protected $dates = ['deleted_at'];
}
