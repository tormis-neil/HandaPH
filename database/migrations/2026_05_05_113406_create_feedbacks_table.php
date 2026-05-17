<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('effectiveness');
            $table->unsignedTinyInteger('efficiency');
            $table->unsignedTinyInteger('satisfaction_usefulness');
            $table->unsignedTinyInteger('satisfaction_trust');
            $table->unsignedTinyInteger('satisfaction_pleasure');
            $table->unsignedTinyInteger('satisfaction_comfort');
            $table->unsignedTinyInteger('risk_economic');
            $table->unsignedTinyInteger('risk_health_safety');
            $table->unsignedTinyInteger('risk_environmental');
            $table->unsignedTinyInteger('context_coverage');
            $table->unsignedTinyInteger('flexibility');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('feedbacks');
    }
};