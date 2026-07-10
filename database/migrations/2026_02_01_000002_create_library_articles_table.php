<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Individual topics uploaded under a library section — e.g. under
 * "Heart Conditions": Coronary Artery Disease, Heart Failure, Arrhythmia…
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_section_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();

            // Slugs only need to be unique within their section.
            $table->unique(['library_section_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_articles');
    }
};
