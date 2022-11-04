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
        Schema::create('committee_has_members', function (Blueprint $table) {

            //todo
            $table->id();
            $table->foreignIdFor(\App\Models\Backend\Committee::class);
            //Eğer sistemdeki kullanıcı ile ilişkilendirilecekse bu alan doldurulacak.
            $table->integer('user_id')->nullable();
            $table->string('name',100);
            $table->string('surname',100);
            $table->string('photo')->nullable();
            $table->integer('order')->default(0);
            $table->text('roles')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee_has_members');
    }
};
