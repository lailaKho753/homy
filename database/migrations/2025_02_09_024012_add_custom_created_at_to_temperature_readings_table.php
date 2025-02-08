<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_custom_created_at_to_temperature_readings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomCreatedAtToTemperatureReadingsTable extends Migration
{
    public function up()
    {
        Schema::table('temperature_readings', function (Blueprint $table) {
            // Add a custom_created_at column (string type to store the formatted date)
            $table->string('custom_created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('temperature_readings', function (Blueprint $table) {
            // Remove the custom_created_at column if rolling back the migration
            $table->dropColumn('custom_created_at');
        });
    }
}

