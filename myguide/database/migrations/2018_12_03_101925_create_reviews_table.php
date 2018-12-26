<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('events_id')->unsigned()->index();
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
            $table->string('events_name')->references('name')->on('events')->onDelete('cascade');
            $table->integer('users_id')->unsigned()->index();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('users_name')->references('name')->on('users')->onDelete('cascade');
			$table->string('reviewtext');
			$table->string('pic');
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
        Schema::dropIfExists('reviews');
    }
}
