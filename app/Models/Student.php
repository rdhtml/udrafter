<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    public $table = 'students';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'email',
        'phone',
    ];
}
