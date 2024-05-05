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
        Schema::create('chefservices', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('numero');
            $table->string('domaine');
            $table->string('localisation');
            $table->string('numero_urgence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chefservices');
    }
};
