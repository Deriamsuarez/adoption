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
        Schema::create('pets', function (Blueprint $table) {
        $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->unsignedBigInteger('breed_id');
            $table->enum('type', ['Dog', 'Cat', 'Other']);
            $table->string('photo');
            $table->enum('gender', ['Male', 'Female']);
            $table->float('weight')->nullable();
            $table->enum('energy_level', ['Low', 'Medium', 'High']);
            $table->enum('age', ['Baby', 'Young', 'Adult', 'Senior']);
            $table->enum('current_size', ['Small', 'Medium', 'Large']);
            $table->enum('adult_size', ['Small', 'Medium', 'Large']);
            $table->enum('training_level', ['Basic', 'Intermediate', 'Advanced']);
            $table->enum('coat', ['Short', 'Medium', 'Long', 'Curly', 'Hairless']); // Cambiado a enum
            $table->unsignedBigInteger('province_id');
            $table->enum('temperament', ['Passive', 'Calm', 'Aggressive', 'Friendly', 'Playful', 'Shy'])->nullable();
            $table->boolean('vaccinated')->default(false);
            $table->boolean('dewormed')->default(false);
            $table->boolean('neutered')->default(false);
            $table->boolean('special_needs')->default(false);
            $table->text('special_needs_notes')->nullable();
            $table->text('medical_history')->nullable();
            $table->unsignedBigInteger('published_by');


            $table->timestamps();

            $table->foreign('breed_id')->references('id')->on('breeds')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('published_by')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
