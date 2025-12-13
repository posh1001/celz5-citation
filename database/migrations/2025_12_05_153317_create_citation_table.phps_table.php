<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citation_table', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->foreignId('unit_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('group_id')->nullable()->constrained()->onDelete('set null');
            $table->string('designation')->nullable();
            $table->string('handle')->nullable();
            $table->string('phone')->nullable();
            $table->text('citation');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citation_table');
    }
};
