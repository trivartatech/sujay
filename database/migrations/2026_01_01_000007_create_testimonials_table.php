<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->text('content');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->string('image')->nullable();
            // Stored proof of written patient consent (file path on disk).
            $table->string('consent_file')->nullable();
            $table->boolean('is_approved')->default(false)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
