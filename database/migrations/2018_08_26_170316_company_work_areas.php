<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyWorkAreas extends Migration
{
    public function up()
    {
      Schema::create('company_work_areas', function (Blueprint $table) {
          $table->increments('id');
          $table->tinyInteger('company_id');
          $table->string('postnummer');
          $table->timestamps();
      });
    }

    public function down()
    {
        Schema::dropIfExists('company_work_areas');
    }
}
