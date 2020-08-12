<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->text('description')->nullable()->default(null)->after('org_id');
            $table->string('name')->nullable()->default(null)->after('org_id');
            $table->integer('type')->default(1)->after('org_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('name');
            $table->dropColumn('type');
        });
    }
}
