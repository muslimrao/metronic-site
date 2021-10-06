<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('airline_name')->nullable();
            $table->text('about')->nullable();
            $table->string('domain')->nullable();
            $table->string('logo')->nullable();
            $table->integer('plan')->nullable();

            $table->string('currency_type')->nullable();
            $table->string('measurement_type')->nullable();
            $table->string('timezone')->nullable();
            
            $table->integer('status')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airlines');
    }
}
