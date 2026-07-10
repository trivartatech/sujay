<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The six "Heart Health Library" cards on the homepage:
 * Heart Conditions, Symptoms, Tests & Procedures, Prevention & Lifestyle,
 * Medications, Heart Health Articles.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            // Short blurb shown on the homepage card
            $table->string('description', 500)->nullable();
            // Optional longer intro shown at the top of the section page
            $table->longText('body')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_sections');
    }
};
