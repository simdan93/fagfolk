<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPayAdressesTable extends Migration
{
    public function up()
    {
        Schema::create('company_pay_adresses', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('company_id');
            $table->string('faktura_addresse');
            $table->string('faktura_postnummer');
            $table->string('faktura_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_pay_adresses');
    }
}
