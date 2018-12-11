<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('events_type_id')->unsigned()->index();
            $table->foreign('events_type_id')->references('id')->on('events_type')->onDelete('cascade');
            $table->string('events_type_type')->references('type')->on('events_type')->onDelete('cascade');
            $table->string('pic');
			$table->string('name');
            $table->string('about');
            $table->float('price');
            $table->datetime('date');
            $table->integer('nr_pax');
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
        Schema::dropIfExists('events');
    }
}
