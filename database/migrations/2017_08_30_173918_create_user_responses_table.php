<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('user_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('user_id');
            $table->tinyInteger('company_id');
            $table->tinyInteger('userneed_id');
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
        Schema::dropIfExists('user_responses');
    }
}
