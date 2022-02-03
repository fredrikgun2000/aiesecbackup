<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fees extends Model
{
    use SoftDeletes;
    protected $table = 'fees';
    protected $fillable= [
        'project_id',
        'title',
        'description',
        'price',
    ];
    protected $dates = ['deleted_at'];
}
