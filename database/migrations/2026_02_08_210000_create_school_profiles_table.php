<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->nullable();
            $table->string('school_npsn')->nullable();
            $table->string('school_accreditation')->nullable();
            $table->string('school_contact')->nullable();
            $table->string('principal_name')->nullable();
            $table->string('principal_id')->nullable();
            $table->string('address')->nullable();
            $table->string('logo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
