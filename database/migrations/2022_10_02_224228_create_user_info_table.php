<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('license_number')->nullable();
            $table->string('tc_id_number')->nullable();
            $table->string('blood_type')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('occupation')->nullable();
            $table->string('military_obligation_status')->nullable();
            $table->string('educational_status')->nullable();

            //Telefon bilgileri
            $table->string('phone_number')->nullable();
            $table->string('phone_number_alt')->nullable();
            $table->string('phone_number_work')->nullable();
            //Adres bilgileri
            $table->unsignedBigInteger('home_country_id')->nullable();
            $table->foreign('home_country_id')->references('id')->on('countries');
            $table->string('home_address',255)->nullable();
            $table->unsignedBigInteger('work_country_id')->nullable();
            $table->foreign('work_country_id')->references('id')->on('countries');
            $table->string('work_address',255)->nullable();

            //Covid Bilgileri
            $table->string('hes_code')->nullable();
            $table->integer('vac_dose')->nullable();
            $table->dateTime('last_dose_date')->nullable();
            $table->integer('had_covid')->nullable();

            //Yabancı dil bilgileri
            $table->string('first_foreign_language_name')->nullable();
            $table->string('first_foreign_language_level')->nullable();
            $table->string('second_foreign_language_name')->nullable();
            $table->string('second_foreign_language_level')->nullable();

            //banka bilgileri
            $table->string('bank_name')->nullable();
            $table->string('bank_branch_code')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_iban')->nullable();

            //beden bilgileri
            $table->string('sports_size')->nullable();
            $table->string('suit_size')->nullable();
            $table->string('shirt_size')->nullable();
            $table->integer('trainers_size')->nullable();
            $table->integer('shoe_size')->nullable();

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
        Schema::dropIfExists('user_info');
    }
};
