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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Leader_Id');
            $table->unsignedBigInteger('Project_Id');
            $table->string('name');
            $table->foreign('Leader_Id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Project_Id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
