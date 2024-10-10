<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableToAddAddressFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('pincode')->nullable();         // Pin code
            $table->string('address')->nullable();         // Address
            $table->string('locality_town')->nullable();   // Locality or town
            $table->string('city')->nullable();            // City or District
            $table->string('state')->nullable();           // State
            $table->enum('type', ['home', 'work'])->nullable(); // Home or Work
            $table->boolean('default_address')->default(false);  // Default or not

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'pincode', 'address', 'locality_town', 'city', 'state', 'type', 'default_address'
            ]);
        });
    }
}
