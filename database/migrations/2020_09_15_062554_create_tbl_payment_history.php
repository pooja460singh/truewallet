<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPaymentHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payment_history', function (Blueprint $table) {
            $table->id();
            $table->string('remarked');
            $table->string('voucher');
            $table->string('credit_amount');
            $table->string('debit_amount');
            $table->string('email');
            $table->string('contact');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('tbl_payment_history');
    }
}
