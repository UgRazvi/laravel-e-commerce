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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->double('subtotal', 10, 2);
            $table->double('shipping', 10, 2);
            $table->string('coupon_code')->nullable();
            $table->integer('coupon_code_id')->nullable();
            $table->double('discount', 10, 2)->nullable();
            $table->double('grand_total', 10, 2);

            // User Address Related Columns
            $table->string('name');
            // $table->string('last_name');
            // $table->string('email');
            $table->string('mobile_no');
            $table->string('address');
            $table->text('locality_town')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->text('notes')->nullable();
            $table->enum('type', ['home', 'work'])->nullable(); // Home or Work
            $table->boolean('default_address')->default(false);  // Default or not

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
