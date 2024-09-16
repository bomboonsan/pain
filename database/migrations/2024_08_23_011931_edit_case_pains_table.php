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
        Schema::table('case_pains', function (Blueprint $table) {
            // change column name user_id to userId in case_pains
            $table->renameColumn('user_id', 'userId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_pains', function (Blueprint $table) {
            // change column name user_id to userId in case_pains
            $table->renameColumn('user_id', 'userId');
        });
    }
};
