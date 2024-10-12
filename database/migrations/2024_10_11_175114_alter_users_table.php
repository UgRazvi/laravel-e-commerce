<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female'])->nullable()->after('email');
            $table->timestamp('birthday')->nullable()->after('gender');
            $table->string('alternate_mobile_no')->nullable()->after('birthday');
            $table->string('hint_name')->nullable()->after('alternate_mobile_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the correct columns
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('alternate_mobile_no'); // Corrected column name
            $table->dropColumn('hint_name');
        });
    }
};
