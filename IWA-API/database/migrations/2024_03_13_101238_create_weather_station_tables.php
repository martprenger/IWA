<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherStationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create country table
        Schema::create('country', function (Blueprint $table) {
            $table->string('country_code', 2)->primary();
            $table->string('country', 45);
        });

        // Create station table
        Schema::create('station', function (Blueprint $table) {
            $table->string('name', 10)->primary();
            $table->float('longitude');
            $table->float('latitude');
            $table->float('elevation');
        });

        // Create geolocation table
        Schema::create('geolocation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('station_name', 10);
            $table->string('country_code', 2);
            $table->string('island')->nullable();
            $table->string('county')->nullable();
            $table->string('place')->nullable();
            $table->string('hamlet')->nullable();
            $table->string('town')->nullable();
            $table->string('municipality')->nullable();
            $table->string('state_district')->nullable();
            $table->string('administrative')->nullable();
            $table->string('state')->nullable();
            $table->string('village')->nullable();
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('locality')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->foreign('country_code')->references('country_code')->on('country');
            $table->foreign('station_name')->references('name')->on('station');
        });

        // Create nearestlocation table
        Schema::create('nearestlocation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('station_name', 10);
            $table->string('name')->nullable();
            $table->string('administrative_region1')->nullable();
            $table->string('administrative_region2')->nullable();
            $table->string('country_code', 2);
            $table->float('longitude');
            $table->float('latitude');
            $table->foreign('country_code')->references('country_code')->on('country');
            $table->foreign('station_name')->references('name')->on('station');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nearestlocation');
        Schema::dropIfExists('geolocation');
        Schema::dropIfExists('station');
        Schema::dropIfExists('country');
    }
}

