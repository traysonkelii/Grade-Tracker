<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepertoireStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repertoire_student', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->string('repertoire_id');
            $table->foreign('repertoire_id')->references('id')->on('repertoires');
            $table->timestamps();

            $table->primary(['student_id','repertoire_id'])->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repertoire_student');
    }
}
