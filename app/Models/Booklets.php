<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booklets extends Model
{
    use SoftDeletes;
    protected $table = 'booklets';
    protected $fillable= [
        'title',
        'description',
        'file',
        'publish',
    ];
    protected $dates = ['deleted_at'];
}
