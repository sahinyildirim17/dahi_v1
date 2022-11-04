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
        // Zamanla kullanıcılar sistemden silinebiliyor.
        // Ömer ÇOMRUK örneğinde başa geldiği gibi sonrasında bu kullanıcıların
        // sistemdeki eski maç sayfalarında sorunsuz görünmesi gerek
        // O yüzden softdeletes kullanıyoruz ve maç sayfalarında silinenlerle birlikte çağırıyoruz.
        Schema::table('users', function (Blueprint $table) {
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
