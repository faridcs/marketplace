<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable(true);
            $table->string('password')->nullable();
            $table->smallInteger('type')->default(0)->nullable();
            $table->smallInteger('status')->default(1)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
