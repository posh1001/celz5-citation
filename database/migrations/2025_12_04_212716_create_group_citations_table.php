<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupCitationsTable extends Migration
{
    public function up()
    {
        Schema::create('group_citations', function (Blueprint $table) {
            $table->id();

            // Step 1
            $table->string('name');
            $table->string('phone');
            $table->string('kingschat')->nullable();

            // Step 2
            $table->string('unit')->nullable();
            $table->string('designation')->nullable();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();

            // Step 3
            $table->string('title');
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_citations');
    }
}
