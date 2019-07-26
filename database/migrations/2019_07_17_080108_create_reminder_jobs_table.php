<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('starting_date');
            $table->string('ending_date');
            $table->string('execution_type');
            $table->string('executed_time')->nullable()->default(null);
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
        Schema::dropIfExists('reminder_jobs');
    }
}
