<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventparticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('participant_id');
            $table->boolean('signin')->default(0);
            $table->datetime('in_time')->nullable();
            $table->boolean('signout')->default(0);
            $table->datetime('out_time')->nullable();
            $table->string('barcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventparticipants');
    }
}
