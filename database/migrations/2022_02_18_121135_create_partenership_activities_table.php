<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartenershipActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partenership_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Title');
            $table->string('Description');
            $table->date('Date');
            $table->string('Type');
            $table->unsignedBigInteger('partener_id');
            $table->timestamps();
        });
    }
   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partenership_activities');
    }
}
