<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rent_user', function (Blueprint $table) {
            $table->increments('c_user_id');
            $table->string('c_user_full_name', 50);
            $table->string('c_user_email', 50);
            $table->string('c_user_password', 100);
            $table->integer('c_user_role');
            $table->integer('c_user_status');
            $table->integer('c_user_update_by');
            $table->datetime('c_user_update_time');
            $table->string('c_user_last_login_ip', 50)->nullable();
            $table->datetime('c_user_last_login_date')->nullable();
            $table->integer('c_user_soft_delete');
            $table->integer('c_user_force_change_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_rent_user');
    }
}
