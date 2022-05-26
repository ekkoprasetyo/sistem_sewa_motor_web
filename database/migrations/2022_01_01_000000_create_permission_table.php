<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rent_permission', function (Blueprint $table) {
            $table->increments('c_permission_id');
            $table->string('c_permission_name', 50)->unique();
            $table->string('c_permission_display', 50)->unique();
            $table->string('c_permission_description', 255);
            $table->integer('c_permission_update_by');
            $table->datetime('c_permission_update_time');
            $table->integer('c_permission_soft_delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_rent_permission');
    }
}
