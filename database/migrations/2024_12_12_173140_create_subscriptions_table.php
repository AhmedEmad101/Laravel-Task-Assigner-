<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_Id');
            $table->unsignedBigInteger('tier_id');
            $table->timestamps();
            $table->timestamp('expires_at')->nullable();
            $table->foreign('user_Id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tier_id')->references('id')->on('tiers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
