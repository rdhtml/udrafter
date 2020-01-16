<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeeIdToBusinessStudentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_student_status', function (Blueprint $table) {
            $table->unsignedInteger('employee_id')
                ->index('fk_business_student_status_employee_idx')->after('status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_student_status', function (Blueprint $table) {
            $table->dropColumn('employee_id');
        });
    }
}
