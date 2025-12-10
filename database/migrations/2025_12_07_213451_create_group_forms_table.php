<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('fullname');
            $table->string('unit');
            $table->string('designation');
            $table->string('kingschat');
            $table->string('phone');
            $table->string('department');
            $table->string('period');
            $table->text('citation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_forms');
    }
};
