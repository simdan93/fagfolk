<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPayAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('user_pay_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('user_id');
            $table->string('faktura_addresse');
            $table->string('faktura_postnummer');
            $table->string('faktura_by');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('user_pay_addresses');
    }
}
