<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained('statuses');
            $table->foreignId('unit_id')->constrained('units');
            $table->string('code', 10)->unique();
            $table->string('name')->unique();
            $table->integer('base_price');
            $table->integer('profit');
            $table->float('stock');
            $table->float('minimum_stock');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('products');
    }
}
