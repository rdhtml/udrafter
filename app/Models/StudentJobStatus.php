<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentJobStatus extends Model
{
    use SoftDeletes;

    const POTENTIAL = 2;

    public $table = 'student_job_status';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'status'
    ];

    public static function kvlist()
    {
        return self::pluck('status','id')->sort();
    }
}
