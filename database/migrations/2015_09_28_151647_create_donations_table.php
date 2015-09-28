<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
        
            $table->enum('status', ['unassigned','pending','donated','disinterested'])->default('unassigned');
            $table->integer('promised_amount');
            $table->timestamp('appointment');
            
            $table->integer('donated_amount')->nullable();
            $table->timestamp('donated_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->integer('donor_id')->unsigned();
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
            
            $table->integer('teamleader_id')->nullable()->unsigned();
            $table->foreign('teamleader_id')->references('id')->on('users');

            $table->integer('telecaller_id')->nullable()->unsigned();
            $table->foreign('telecaller_id')->references('id')->on('users');

            $table->integer('fieldexecutive_id')->nullable()->unsigned();
            $table->foreign('fieldexecutive_id')->references('id')->on('users');

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
        Schema::drop('donations');
    }
}
