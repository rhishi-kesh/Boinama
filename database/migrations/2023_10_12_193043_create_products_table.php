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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('discount')->nullable();
            $table->string('quantity');
            $table->string('subject_id');
            $table->string('prakasani_id');
            $table->string('writer_id');
            $table->string('user_id');
            $table->string('image');
            $table->string('slug');
            $table->string('preview')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default(1)->comment('0 = Active & 1 = Deactive');
            $table->string('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
