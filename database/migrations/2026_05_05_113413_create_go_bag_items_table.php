<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('go_bag_items', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['essentials', 'recommended', 'optional']);
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('budget_alternative')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('go_bag_items');
    }
};