<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function(Blueprint $table){

            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('account_phones', function(Blueprint $table){

            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedBigInteger('number');

            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->onDelete('cascade');
        });

        Schema::create('account_emails', function(Blueprint $table){

            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->string('address');

            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_phones');
        Schema::dropIfExists('account_emails');
        Schema::dropIfExists('accounts');
    }
}
