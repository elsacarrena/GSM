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
        Schema::create('superieurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('domaine');
            $table->string('ponctualite');
            $table->string('assiduite');
            $table->string('creativite');
            $table->string('engagement');
            $table->string('motivation');
            $table->string('initiative');
            $table->string('sociabilite');
            $table->string('gout_risque');
            $table->string('autres_appreciations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('superieurs');
    }
};
