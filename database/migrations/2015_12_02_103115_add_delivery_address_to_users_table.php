<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeliveryAddressToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_number');
            $table->string('street');
            $table->string('county');
            $table->string('town_city');
            $table->string('postcode');
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
            $table->dropColumn('name_number');
            $table->dropColumn('street');
            $table->dropColumn('county');
            $table->dropColumn('town_city');
            $table->dropColumn('postcode');
        });
    }
}
