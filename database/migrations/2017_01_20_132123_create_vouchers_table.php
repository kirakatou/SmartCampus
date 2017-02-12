<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')
                  ->references('id')->on('events');
            $table->integer('participant_id');
            $table->string('status');
            $table->string('no')->unique()->nullable();
            $table->double('price');
            $table->date('receipt_date');
            $table->boolean('paid')->default(0);
            $table->boolean('void')->default(0);
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
        Schema::dropIfExists('vouchers');
    }
}
