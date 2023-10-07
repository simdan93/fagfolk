<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('company_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('req_company_id'); //Requesting company. This can disturb ORM
            $table->tinyInteger('company_id');
            $table->tinyInteger('companyneed_id');
            $table->string('response_message');
            $table->boolean('akseptert')->default(false);
            $table->boolean('ignorert')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('company_responses');
    }
}
