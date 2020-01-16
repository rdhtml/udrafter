<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessStudentStatus extends Model
{
    use SoftDeletes;

    public $table = 'business_student_status';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'business_id',
        'student_id',
        'status_id',
        'employee_id',
        'deleted_at'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function status()
    {
        return $this->belongsTo(StudentJobStatus::class,'status_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function employee()
    {
        return $this->belongsTo(User::class,'employee_id', 'id');
    }



}
