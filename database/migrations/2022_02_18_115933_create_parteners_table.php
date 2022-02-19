<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parteners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nom');
            $table->string('presentation');
            $table->string('partnership_type');
            $table->string('partnership_status');
            $table->string('partner_type');
            $table->boolean('is_partenerOfYear');
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
        Schema::dropIfExists('parteners');
    }
}
