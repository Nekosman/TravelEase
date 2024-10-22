<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('destination');
            $table->date('travel_date');
            $table->timestamps(); // This will create 'created_at' and 'updated_at' fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
