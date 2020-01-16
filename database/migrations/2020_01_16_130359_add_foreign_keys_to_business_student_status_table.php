<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToBusinessStudentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_student_status', function (Blueprint $table) {
            $table->foreign('business_id', 'fk_business_student_status_business')->references('id')->on('business')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('student_id', 'fk_business_student_status_user')->references('id')->on('students')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('status_id', 'fk_business_student_status_status')->references('id')->on('student_job_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_business_student_status_business');
            $table->dropForeign('fk_business_student_status_user');
            $table->dropForeign('fk_business_student_status_status');
        });
    }
}
