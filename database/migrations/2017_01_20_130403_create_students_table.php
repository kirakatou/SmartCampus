<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim', 20)->unique();
            $table->string('name');
            $table->integer('gender');
            $table->date('dob');
            $table->string('email');
            $table->string('religion');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')
                  ->references('id')->on('departments');
            $table->string('classname');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('students');
    }
}
