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
            $table->longText('positions')->nullable()->after('pains');
            $table->string('level')->nullable()->after('positions');
            $table->longText('symptom')->nullable()->after('level');
            $table->longText('meds')->nullable()->after('symptom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_pains', function (Blueprint $table) {
            $table->longText('positions')->nullable()->after('pains');
            $table->string('level')->nullable()->after('positions');
            $table->longText('symptom')->nullable()->after('level');
            $table->longText('meds')->nullable()->after('symptom');
        });
    }
};
