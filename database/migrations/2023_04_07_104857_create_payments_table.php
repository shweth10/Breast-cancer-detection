<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('client_fname');
            $table->string('card_fname');
            $table->string('exp_date');
            $table->string('client_email');
            $table->integer('premium_amount');
            $table->bigInteger('card_number');
            $table->integer('cvv');
            $table->string('payment_period');
            $table->string('policy_type');
            $table->date('payment_date');
            $table->date('next_payment_date');
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
        Schema::dropIfExists('payments');
    }
}
