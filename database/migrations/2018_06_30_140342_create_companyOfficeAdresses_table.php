<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyOfficeAdressesTable extends Migration
{
    public function up()
    {
        Schema::create('company_office_adresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('kontor_addresse');
            $table->string('kontor_postnummer');
            $table->string('kontor_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_office_adresses');
    }
}
