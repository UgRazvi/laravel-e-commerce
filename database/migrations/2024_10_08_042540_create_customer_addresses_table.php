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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('customer_addresses');
    }
};
