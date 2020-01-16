<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    public $table = 'business';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'address1',
        'address2',
        'city',
        'postcode'
    ];

}
