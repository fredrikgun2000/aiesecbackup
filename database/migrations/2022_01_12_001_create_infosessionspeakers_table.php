<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosessionspeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infosessionspeakers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->String('full_name');
            $table->longText('profession');
            $table->longText('title');
            $table->longText('contact')->nullable();
            $table->longText('description')->nullable();
            $table->String('photo');
            $table->String('publish')->default('0');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

            $table->foreign('program_id')->references('id')->on('infosessionprograms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infosessionspeakers');
    }
}
