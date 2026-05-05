<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('checklist_rules', function (Blueprint $table) {
            $table->id();
            $table->text('item_text');
            $table->enum('phase', ['before', 'during', 'after']);
            $table->string('tag');
            $table->string('tag_class');
            $table->json('locations');
            $table->json('sizes');
            $table->json('special_needs');
            $table->json('house_types');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('checklist_rules');
    }
};