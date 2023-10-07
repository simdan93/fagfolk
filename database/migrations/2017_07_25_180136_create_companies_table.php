<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('navn');
            $table->string('etternavn');
            $table->integer('telefon')->nullable();
            $table->integer('mobil');
            $table->string('email')->unigue();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
