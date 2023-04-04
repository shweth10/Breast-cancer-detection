<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->integer('Insurer_id');
            $table->string('policy_type');
            $table->integer('coverage_amount');
            $table->text('coverage_information')->nullable();
            $table->integer('premium_amount');
            $table->integer('policy_duration');
            $table->enum('payment_period', ['monthly', 'quarterly', 'annually']);
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
        Schema::dropIfExists('policies');
    }
}
