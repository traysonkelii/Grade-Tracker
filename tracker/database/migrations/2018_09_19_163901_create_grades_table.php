<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->integer('repertoire_id')->unsigned();
            $table->foreign('repertoire_id')->references('id')->on('repertoires');
            $table->string('term');
            $table->timestamps();

            $table->primary(['repertoire_id','student_id'])->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
