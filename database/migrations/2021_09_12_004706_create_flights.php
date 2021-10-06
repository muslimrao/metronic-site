<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_history', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('pilot_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            
            $table->string('flight_number')->nullable();

            $table->foreignId('aircraft_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');


            $table->text('report')->nullable();;

            $table->dateTime("airport_depart")->nullable();;
            $table->dateTime("airport_arrive")->nullable();;


            $table->string('route')->nullable();;
            $table->integer('status')->nullable();;
            $table->text('flight_data')->nullable();;

            $table->string('landing_rate')->nullable();;
            $table->string('miles')->nullable();;

            $table->string('fuel')->nullable();;
            $table->decimal('flight_time')->default(0)->nullable();;

            $table->string('passengers')->nullable();;



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
        Schema::dropIfExists('flight_history');
    }
}
