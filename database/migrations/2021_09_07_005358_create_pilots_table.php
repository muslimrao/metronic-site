<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pilot_role_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('rank_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('hub_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->text("bio")->nullable();
            $table->string('user_image')->nullable();

            $table->string('call_sign')->nullable();
            $table->integer('number_flights')->nullable()->default(0);
            $table->integer('vatsim_id')->nullable()->default(0);
            $table->string('notifications')->nullable();
            $table->date("join_date")->nullable()->default(date("Y-m-d"));

            $table->rememberToken();
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
        Schema::dropIfExists('pilots');
    }
}
