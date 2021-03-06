<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastPushErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('pusher.tables.past_push_errors'), function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('past_push_id');
            $table->unsignedInteger('user_id');
            $table->string('error');
            $table->timestamps();

            $table->foreign('past_push_id')
                ->references('id')->on(config('pusher.tables.past_push'))
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id')
                ->references(config('pusher.user_pk'))->on(config('pusher.tables.users'))
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('pusher.tables.past_push_errors'));
    }
}
