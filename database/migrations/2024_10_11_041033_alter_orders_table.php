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

        Schema::table('orders', function (Blueprint $table) {
            $table->enum('order_status', ['pending', 'shipped', 'delivered'])->nullable()->after('pincode');
            $table->enum('payment_status', ['paid', 'not_paid'])->nullable()->after('order_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_status');
            $table->dropColumn('payment_status');
        });
    }
};
