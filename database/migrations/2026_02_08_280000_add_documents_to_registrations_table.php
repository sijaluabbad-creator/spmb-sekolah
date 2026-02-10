<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('birth_certificate_path')->nullable();
            $table->string('family_card_path')->nullable();
            $table->string('mother_id_path')->nullable();
            $table->string('photo_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'birth_certificate_path',
                'family_card_path',
                'mother_id_path',
                'photo_path',
            ]);
        });
    }
};
