<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyNeedsTable extends Migration
{
    public function up()
    {
        Schema::create('company_needs', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('req_company_id');
            $table->tinyInteger('mainservice_id');
            $table->tinyInteger('secondaryservice_id');
            $table->string('postnummer');
            $table->string('tilgjengelig');
            $table->string('oppsummering');
            $table->string('beskrivelse')->nullable();
            $table->boolean('gyldig')->default(true);
            $table->boolean('befaring')->default(false);
            $table->integer('antall_aksepterte_befaringer')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_needs');
    }
}
