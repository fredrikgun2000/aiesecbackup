<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infosessionquestions extends Model
{
    use SoftDeletes;
    protected $table = 'infosessionquestions';
    protected $fillable= [
        'form_id',
        'type',
        'file',
        'text',
        'description',
        'option',
        'section_id',
    ];
    protected $dates = ['deleted_at'];
}
