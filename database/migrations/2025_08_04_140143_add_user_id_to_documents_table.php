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
        Schema::table('documents', function (Blueprint $table) {
            // Add the new user_id column after the 'file_type' column
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('file_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // This code allows the migration to be reversible
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
