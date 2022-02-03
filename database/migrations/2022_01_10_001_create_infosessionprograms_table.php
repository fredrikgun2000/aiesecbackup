<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosessionprogramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infosessionprograms', function (Blueprint $table) {
            $table->id();
            $table->String('theme');
            $table->String('sdgs');
            $table->longText('faculty');
            $table->String('poster');
            $table->String('datetime');
            $table->longText('description')->nullable();
            $table->String('link_meet')->nullable();
            $table->String('link_content')->nullable();
            $table->String('publish')->default('0');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infosessionprograms');
    }
}
