<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('survey_submissions', function (Blueprint $table) {
            $table->id();
            $table->enum('location', ['coastal', 'mountainous', 'inland', 'flood-prone']);
            $table->enum('household_size', ['1', '2-4', '5-7', '8-plus']);
            $table->json('special_needs');
            $table->enum('house_type', ['light', 'semi-concrete', 'concrete']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('survey_submissions');
    }
};