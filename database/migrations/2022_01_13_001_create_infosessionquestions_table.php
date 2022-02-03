<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosessionquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infosessionquestions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->String('type')->nullable();
            $table->String('file')->nullable();
            $table->longText('text')->nullable()->default('');
            $table->longText('description')->nullable()->default('');
            $table->longText('option')->nullable();
            $table->longText('section_id')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

            $table->foreign('form_id')->references('id')->on('infosessionforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infosessionquestions');
    }
}
