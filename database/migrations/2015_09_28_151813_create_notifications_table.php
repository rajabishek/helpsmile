<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $events = [
            'donor.created',
            'donation.created',
            'donation.successful',
            'donation.cancelled',
            'donation.assigned'
        ];

        Schema::create('notifications', function (Blueprint $table) use ($events){
            $table->increments('id');

            $table->string('title');
            $table->text('description');
            $table->enum('type', $events);
            
            $table->timestamp('happened_at');
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
        Schema::drop('notifications');
    }
}
