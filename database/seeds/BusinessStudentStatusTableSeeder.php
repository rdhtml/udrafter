<?php

use App\Models\Business;
use App\Models\Student;
use App\Models\StudentJobStatus;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessStudentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $businessId = Business::first()->id;

        $employees = User::where('business_id',$businessId)->pluck('id')->toArray();

        $students = Student::all();

        foreach($students as $student) {

            $employee = array_rand($employees, 1);

            DB::table('business_student_status')->insert([
                'business_id' => $businessId,
                'student_id' => $student->id,
                'status_id' =>  StudentJobStatus::POTENTIAL,
                'employee_id' =>  $employees[$employee],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        }


    }
}
