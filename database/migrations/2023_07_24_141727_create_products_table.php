<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {        
        Schema::create('products', function (Blueprint $collection) {
            $collection->id();
            $collection->index('name');
            $collection->string('slug')->unique();
            $collection->string('description');
            $collection->array('specifications');
            $collection->array('price_history');
            $collection->json('discount');
            $collection->integer('wishlist_count');
            $collection->array('categories');
            $collection->array('variants');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
