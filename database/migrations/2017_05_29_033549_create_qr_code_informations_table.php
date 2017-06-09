<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQrCodeInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('qr_code_informations', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('merchantId');
            $table->string('productId')->unique();
            $table->date('validity');
            $table->integer('merchantId')->unsigned();//info from request
            $table->foreign('merchantId')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->integer('userId')->unsigned();//current user
            $table->foreign('userId')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
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
        //
        Schema::dropIfExists('qr_code_informations');
    }
}
