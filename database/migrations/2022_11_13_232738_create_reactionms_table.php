<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReactionmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactionms', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('typereaction_id')->unsigned()->nullable();
            $table->foreign('typereaction_id')->references('id')->on('typereactions')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedBigInteger('reactionmable_id');

            $table->string('reactionmable_type');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('reactionms');
    }
}
