<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorRentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rent_motor_rent', function (Blueprint $table) {
            $table->increments('c_motor_rent_id');
            $table->string('c_motor_rent_renter_name', 50);
            $table->string('c_motor_rent_renter_id', 50);
            $table->string('c_motor_rent_renter_phone', 14);
            $table->string('c_motor_rent_renter_address', 255);
            $table->integer('c_motor_rent_motor');
            $table->date('c_motor_rent_start_rent_date');
            $table->date('c_motor_rent_end_rent_date')->nullable();
            $table->integer('c_motor_rent_duration')->nullable();
            $table->integer('c_motor_rent_total_price')->nullable();
            $table->string('c_motor_rent_note', 255);
            $table->integer('c_motor_rent_status');
            $table->integer('c_motor_rent_update_by');
            $table->datetime('c_motor_rent_update_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_rent_rent_motor');
    }
}
