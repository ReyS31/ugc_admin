<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            $table->string('desc');
            $table->boolean('money_in');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('latest_amount');
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
        Schema::dropIfExists('daily_logs');
    }
}
