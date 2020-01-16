<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessStudentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_student_status', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index('fk_business_student_status_business_idx');
            $table->unsignedInteger('student_id')->index('fk_business_student_status_user_idx');
            $table->unsignedInteger('status_id')->index('fk_business_student_status_status_idx');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_student_status');
    }
}
