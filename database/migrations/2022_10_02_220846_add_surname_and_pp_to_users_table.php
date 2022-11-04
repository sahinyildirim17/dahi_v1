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
        // Varsayılan kullanıcılar tablosuna gerekli detay sütunlarını ekliyoruz.
        Schema::table('users', function (Blueprint $table) {
            $table->string("surname")->after("name");
            $table->string("profile_photo")->after("email")->nullable();
            $table->string('profile_slug')->nullable()->unique()->after('email'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
        });
    }
};
