<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMotorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rent_master_motor', function (Blueprint $table) {
            $table->increments('c_master_motor_id');
            $table->string('c_master_motor_brand', 50);
            $table->string('c_master_motor_series', 50);
            $table->string('c_master_motor_number_plate', 10)->unique();
            $table->integer('c_master_motor_price');
            $table->string('c_master_motor_description', 255);
            $table->integer('c_master_motor_status');
            $table->integer('c_master_motor_update_by');
            $table->datetime('c_master_motor_update_time');
            $table->integer('c_master_motor_soft_delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_rent_master_motor');
    }
}
