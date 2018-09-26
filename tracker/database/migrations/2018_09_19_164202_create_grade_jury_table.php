<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeJuryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_jury', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('jury_id');
            $table->foreign('jury_id')->references('id')->on('jury');
            $table->integer('grade_id')->unsigned();
            $table->foreign('grade_id')->references('id')->on('grades');
            $table->double('score');
            $table->timestamps();

            $table->primary(['jury_id','grade_id'])->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_jury');
    }
}
