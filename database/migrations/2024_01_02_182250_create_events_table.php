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
            $table->string('event_name');
            $table->date('date'); //Date de l'évènement
            $table->time('time'); //Heure de l'évènement
            $table->string('location'); // Lieu de l'évènement
            $table->text('location_description'); //Description du lieu de l'évènement
            $table->integer('min_people');
            $table->integer('max_people');
            $table->string('type'); // outdoor or indoor
            $table->string('people_type'); // between_parents or parents_children
            $table->string('status')->default('active'); // active or inactive
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
