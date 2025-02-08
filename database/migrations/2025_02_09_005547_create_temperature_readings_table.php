<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemperatureReadingsTable extends Migration
{
    public function up()
    {
        Schema::create('temperature_readings', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->float('temperature'); // Store the temperature value
            $table->timestamps(); // Automatically store created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('temperature_readings');
    }
}
