<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('rating');
            $table->enum('easy_to_understand', ['yes_very_easy', 'somewhat', 'confusing'])->nullable();
            $table->enum('helpful_prepare', ['yes_very_helpful', 'somewhat_helpful', 'no_not_really'])->nullable();
            $table->text('improve_comments')->nullable();
            $table->string('region')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('feedbacks');
    }
};