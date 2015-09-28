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

            $table->integer('organisation_id')->unsigned();
            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade');

            $table->string('email')->unique();
            $table->string('fullname');
            $table->string('password', 60);
            $table->text('address')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('designation', ['Admin','Team Leader','Telecaller','Field Coordinator','Field Executive','Manager']);
            $table->string('profile')->nullable();

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
        Schema::drop('users');
    }
}
