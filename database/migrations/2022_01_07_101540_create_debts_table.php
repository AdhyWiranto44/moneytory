<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debt_type_id')->constrained('debt_types');
            $table->foreignId('debt_status_id')->constrained('debt_statuses');
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('on_behalf_of');
            $table->string('phone_number');
            $table->string('address');
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
        Schema::dropIfExists('debts');
    }
}
