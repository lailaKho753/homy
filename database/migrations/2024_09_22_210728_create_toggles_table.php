<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTogglesTable extends Migration
{
    public function up()
    {
        Schema::create('toggles', function (Blueprint $table) {
            $table->id();
            $table->string('lamp_id')->unique(); // Unique ID for each lamp
            $table->boolean('state')->default(false); // Default state as OFF (false)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('toggles');
    }
}
