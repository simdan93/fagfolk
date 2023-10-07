<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHomeAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('user_home_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('addresse');
            $table->string('postnummer');
            $table->string('sted');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('user_home_addresses');
    }
}
