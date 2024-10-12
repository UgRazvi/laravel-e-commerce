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
        Schema::create('acc_del_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing users table
            $table->enum('prod_exp', ['yes', 'no'])->nullable();
            $table->enum('bad_return', ['yes', 'no'])->nullable();
            $table->enum('less_variety', ['yes', 'no'])->nullable();
            $table->enum('excessive_communication', ['yes', 'no'])->nullable();
            $table->enum('other', ['yes', 'no'])->nullable();
            $table->text('suggestions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acc_del_infos');
    }
};
