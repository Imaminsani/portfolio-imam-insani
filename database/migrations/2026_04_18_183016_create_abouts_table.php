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
        Schema::create('abouts', function (Blueprint $blade) {
            $blade->id();
            $blade->string('name')->nullable();
            $blade->string('hero_title')->nullable();
            $blade->text('hero_subtitle')->nullable();
            $blade->string('about_eyebrow')->nullable();
            $blade->string('about_title')->nullable();
            $blade->text('about_description')->nullable();
            $blade->string('profile_image')->nullable();
            $blade->string('github_url')->nullable();
            $blade->string('linkedin_url')->nullable();
            $blade->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
