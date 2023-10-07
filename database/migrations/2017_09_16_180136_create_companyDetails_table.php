<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('company_id'); //F
            $table->string('selskap');
            $table->string('org_nummer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_details');
    }
}
