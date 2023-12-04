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
        Schema::create('website_informations', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('address');
            $table->string('number');
            $table->string('gmail');
            $table->string('facebook');
            $table->string('linkedin');
            $table->string('instragram');
            $table->string('youtube');
            $table->string('twitter');
            $table->string('fabout');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_informations');
    }
};
