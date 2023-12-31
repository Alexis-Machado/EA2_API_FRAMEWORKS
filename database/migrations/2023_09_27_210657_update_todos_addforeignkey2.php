<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTodosAddforeignkey2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->renameColumn('categoryid', 'category_id');
            $table->foreign('category_id')->references('id')->on('categories')->after('title');
        

            $table->renameColumn('descriptionid', 'description_id');
            $table->foreign('description_id')->references('id')->on('categories')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
