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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('writer_id');
            $table->foreign('writer_id')->references('id')->on('users');
            $table->integer('post_type')->default(1);
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->string('featured_photo')->nullable();
            $table->integer('is_active')->default(0);
            $table->integer('is_featured')->default(0);
            $table->integer('counter')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
};
