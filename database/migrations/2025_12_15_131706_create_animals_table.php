<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id(); // Crée un bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT
            $table->string('name', 191);
            $table->string('type', 191);
            $table->text('image');
            $table->text('description');
            $table->timestamps(); // Crée created_at et updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};