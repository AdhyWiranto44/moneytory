<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { // id, name, role_id, url, icon, created_at, updated_at
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_menu_id')->constrained('main_menus');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('display');
            $table->string('url');
            $table->string('icon');
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
        Schema::dropIfExists('menus');
    }
}
