<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDateDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_dimensions', function (Blueprint $table) {
            $table->date('date')->primary();
            $table->unsignedInteger('day');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->string('day_name');
            $table->string('day_suffix', 2);
            $table->unsignedInteger('day_of_week');
            $table->unsignedInteger('day_of_year');
            $table->unsignedInteger('is_weekend');
            $table->unsignedInteger('week');
            $table->unsignedInteger('iso_week');
            $table->unsignedInteger('week_of_month');
            $table->unsignedInteger('week_of_year');
            $table->unsignedInteger('iso_week_in_year');
            $table->string('month_name');
            $table->string('month_year');
            $table->string('month_name_year');
            $table->date('first_day_of_month');
            $table->date('last_day_of_month');
            $table->date('first_day_of_next_month');
            $table->unsignedInteger('quarter');
            $table->string('quarter_name');
            $table->date('first_day_of_quarter');
            $table->date('last_day_of_quarter');
            $table->date('first_day_of_year');
            $table->date('last_day_of_year');
            $table->date('first_day_of_next_year');
            $table->unsignedInteger('dow_in_month');
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
        Schema::dropIfExists('date_dimensions');
    }
}