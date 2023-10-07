<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryServicesTable extends Migration
{
    public function up()
    {
        Schema::create('secondary_services', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('mainservice_id'); //F
            $table->string('spesialisering');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('secondary_services');
    }
}