<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->integer('STN');
            $table->date('DATE');
            $table->time('TIME');
            $table->decimal('TEMP');
            $table->decimal('DEWP');
            $table->decimal('STP');
            $table->decimal('SLP');
            $table->decimal('VISIB');
            $table->decimal('WDSP');
            $table->decimal('PRCP');
            $table->decimal('SNDP');
            $table->string('FRSHTT');
            $table->decimal('CLDC');
            $table->integer('WNDDIR');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('weather_data');
    }
};
