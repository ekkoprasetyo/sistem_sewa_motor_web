<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rent_role', function (Blueprint $table) {
            $table->increments('c_role_id');
            $table->string('c_role_name', 50)->unique();
            $table->string('c_role_display', 50)->unique();
            $table->string('c_role_description', 255);
            $table->integer('c_role_update_by');
            $table->datetime('c_role_update_time');
            $table->integer('c_role_soft_delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_rent_role');
    }
}
