<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('datetime');
            $table->string('location');
            $table->integer('type');
            $table->boolean('pay')->nullable()->default(0);
            $table->double('price')->nullable()->default(0);
            $table->integer('capacity');
            $table->string('image');
            $table->string('poster');
            $table->string('banner');
            $table->text('description');
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
        Schema::dropIfExists('events');
    }
}
