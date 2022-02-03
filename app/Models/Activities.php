<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activities extends Model
{
    use SoftDeletes;
    protected $table = 'activities';
    protected $fillable= [
        'project_id',
        'time',
        'title',
        'detail',
    ];
    protected $dates = ['deleted_at'];
}
