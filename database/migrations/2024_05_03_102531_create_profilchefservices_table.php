<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profilchefservices', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('numero');
            $table->string('domaine');
            $table->string('groupe_sanguin');
            $table->string('maladie');
            $table->string('localisation');
            $table->string('nom_pere');
            $table->string('nom_mere');
            $table->string('numero_pere');
            $table->string('numero_mere');
            $table->string('numero_urgence');
            $table->foreignId('users_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profilchefservices');
    }
};
