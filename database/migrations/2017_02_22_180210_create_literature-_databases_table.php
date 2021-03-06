<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiteratureDatabasesTable extends Migration
{
    public function up()
    {
        Schema::create('database_literature', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('database_id');
            $table->unsignedInteger('literature_id');
            $table->date('date')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('database_literature');
    }
}
