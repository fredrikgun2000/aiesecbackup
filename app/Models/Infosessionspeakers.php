<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infosessionspeakers extends Model
{
    use SoftDeletes;
    protected $table = 'infosessionspeakers';
    protected $fillable= [
        'program_id',
        'full_name',
        'profession',
        'title',
        'contact',
        'description',
        'photo',
        'publish',
    ];
    protected $dates = ['deleted_at'];
}
