<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTemperatureReadingsTable extends Migration
{
    public function up()
    {
        Schema::table('temperature_readings', function (Blueprint $table) {
            // Add a custom string column to store the formatted timestamp
            $table->string('custom_created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('temperature_readings', function (Blueprint $table) {
            // Drop the custom formatted column when rolling back the migration
            $table->dropColumn('custom_created_at');
        });
    }
}
