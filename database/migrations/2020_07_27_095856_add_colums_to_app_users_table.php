<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_users', function (Blueprint $table) {
            $table->integer('deleted')->after('id')->default(0);
            $table->integer('active')->after('id')->default(1);
            $table->string('password')->after('id');
            $table->string('email_verified_at')->after('id')->nullable()->default(NULL);
            $table->string('email')->after('id')->unique();
            $table->string('last_name')->after('id');
            $table->string('first_name')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_users', function (Blueprint $table) {
            $table->dropColumn('deleted');
            $table->dropColumn('active');
            $table->dropColumn('password');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('email');
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
        });
    }
}
