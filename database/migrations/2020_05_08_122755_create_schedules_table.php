<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('id_disciplines');
            $table->integer('id_teacher');
            $table->integer('index_number');
            $table->integer('day');
            $table->enum('week', ['top', 'bottom']);
            $table->integer('id_group');
            $table->integer('id_type_of_discipline');
            $table->integer('id_classroom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
