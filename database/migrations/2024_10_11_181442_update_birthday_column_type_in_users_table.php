<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBirthdayColumnTypeInUsersTable extends Migration

{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Change 'birthday' to be a date type
            $table->date('birthday')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Optionally, revert back to string if needed
            $table->string('birthday')->change();
        });
    }
}

