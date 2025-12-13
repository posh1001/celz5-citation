<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('fullname');
            $table->string('unit');
            $table->string('designation');
            $table->string('kingschat');
            $table->string('phone');
            $table->string('department');
            $table->string('group_name');
            $table->string('period');
            $table->text('citation');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
