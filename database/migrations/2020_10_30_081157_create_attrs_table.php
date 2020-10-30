<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attrs', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("slug");
            $table->integer("group_id")->default(0);

            $table->timestamps();


            $table->index(["group_id"]);
            $table->unique("slug");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attrs');
    }
}
