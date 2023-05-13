<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('sportName');
            $table->string('typePlayer');
            $table->date('schedule');
            $table->unsignedBigInteger('stadiumID');
            $table->foreign('stadiumID')->references('id')->on('stadiums')->onDelete('cascade');
            $table->unsignedBigInteger('event_delailID');
            $table->foreign('event_delailID')->references('id')->on('event_details')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
