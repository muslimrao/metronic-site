<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id(); 
            $table->string('admin_title');
            $table->string('site_title');
            $table->string('email_mode');
            $table->string('email_host');
            $table->string('email_username');
            $table->string('email_password');
            $table->string('email_from');

            $table->string('email_port');
            $table->string('email_from_name');
            $table->string('email_to');
            $table->string('email_subject');
            $table->string('mobilenumber_smsalerts');

            $table->foreignId('airline_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');


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
        Schema::dropIfExists('site_settings');
    }
}
