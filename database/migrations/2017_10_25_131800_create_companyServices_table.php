<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyServicesTable extends Migration
{
    public function up()
    {
        Schema::create('company_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('mainservice_id');
            $table->string('secondaryservice_id')->nullable(); //ssID
            $table->integer('timepris')->default(0);
            $table->integer('oppmøtepris')->default(0);
            $table->boolean('tilgjengelig')->default(true);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('company_services');
    }
}