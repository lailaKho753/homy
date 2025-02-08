<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCreatedAtColumnTypeInTemperatureReadings extends Migration
{
    public function up()
    {
        Schema::table('temperature_readings', function (Blueprint $table) {
            // Change the created_at column to use the 'datetime' type
            $table->dateTime('created_at')->change();
        });
    }

    public function down()
    {
        Schema::table('temperature_readings', function (Blueprint $table) {
            // If you want to rollback, you can change it back to timestamp (or any other type)
            $table->timestamp('created_at')->change();
        });
    }
}

