<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('series_id')->unsigned();
            $table->bigInteger('account_id')->unsigned();
            $table->bigInteger('site_id')->unsigned();
            $table->double('amount', 13, 4)->unsigned();
            $table->text('description');
            $table->enum('type', ['credit', 'debit']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('series_id')->references('id')->on('series');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('site_id')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
