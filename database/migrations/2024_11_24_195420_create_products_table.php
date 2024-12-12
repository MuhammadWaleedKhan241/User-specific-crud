<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('user_id'); // Link product to user
            $table->string('name'); // Product name
            $table->decimal('price', 10, 2); // Product price
            $table->string('sku')->unique(); // SKU
            $table->string('image')->nullable(); // Product image path
            $table->timestamps(); // Created & Updated timestamps

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}