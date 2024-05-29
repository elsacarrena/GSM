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
            $table->string('domaine');
            $table->integer('ponctualite');
            $table->integer('assiduite');
            $table->integer('creativite');
            $table->integer('engagement');
            $table->integer('motivation');
            $table->integer('initiative');
            $table->integer('sociabilite');
            $table->integer('gout_risque');
            $table->integer('autres_appreciations');
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
