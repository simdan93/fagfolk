<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainServicesTable extends Migration
{
    public function up()
    {
        Schema::create('main_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hovedfag');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('main_services');
    }
}