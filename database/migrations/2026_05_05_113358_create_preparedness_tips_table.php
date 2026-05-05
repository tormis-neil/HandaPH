<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('preparedness_tips', function (Blueprint $table) {
            $table->id();
            $table->string('logic_id')->unique();
            $table->string('title');
            $table->text('content');
            $table->enum('tag', ['before', 'during', 'after']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('preparedness_tips');
    }
};