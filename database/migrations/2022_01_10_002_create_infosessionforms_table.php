<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosessionformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infosessionforms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->String('datetime')->nullable();
            $table->String('banner')->nullable();
            $table->longText('title')->nullable()->default('');
            $table->longText('description')->nullable()->default('');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->String('type')->nullable();
            $table->String('publish')->default('0');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

            $table->foreign('program_id')->references('id')->on('infosessionprograms');
            $table->foreign('section_id')->references('id')->on('infosessionforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Infosessionforms');
    }
}
