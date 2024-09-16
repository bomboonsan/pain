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
        Schema::create('case_pains', function (Blueprint $table) {
            $table->id();
            // user_id form line_users
            $table->foreignId('user_id')->constrained('line_users')->onDelete('cascade');
            $table->json('pains');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_pains');
    }
};
