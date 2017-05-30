<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('promoCode')->unique();
            $table->boolean('status');

            $table->integer('qrCodeInformationId')->unsigned();
            $table->foreign('qrCodeInformationId')
                  ->references('id')
                  ->on('qr_code_informations')
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
        Schema::dropIfExists('promotions');
    }
}
