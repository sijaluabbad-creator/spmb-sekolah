<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_level_settings', function (Blueprint $table) {
            $table->id();
            $table->string('level')->unique();
            $table->boolean('is_active')->default(false);
            $table->string('academic_year', 20);
            $table->string('semester', 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_level_settings');
    }
};
