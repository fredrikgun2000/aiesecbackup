<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->longText('banner')->nullable();
            $table->longText('title');
            $table->unsignedBigInteger('destination_id');
            $table->String('agency');
            $table->String('city');
            $table->String('typeofproject');
            $table->String('sdgs');
            $table->longText('description');
            $table->longText('benefit');
            $table->longText('working_hour');
            $table->longText('accomodation')->nullable();
            $table->String('start_date');
            $table->String('end_date');
            $table->String('publish')->default('0');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

            $table->foreign('destination_id')->references('id')->on('destinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
