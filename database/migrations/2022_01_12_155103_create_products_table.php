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
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')
            ->constrained('categories', 'id')
            ->cascadeOnUpdate();
            $table->longText('description')->nullable();
            $table->longText('additional_info')->nullable();
            $table->string('image')->nullable();
            $table->unsignedFLoat('price', 8, 2);
            $table->unsignedFLoat('compare_price', 8, 2)->nullable();
            $table->unsignedFLoat('cost', 8, 2)->nullable();
            $table->unsignedSmallInteger('quantity')->default(0);
            // Stock Keeping Unit
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->enum('status', ['active', 'draft', 'archived']);
            $table->enum('availability', ['in-stock', 'out-of-stock', 'back-order'])->default('in-stock');
            $table->timestamps();
            $table->softDeletes();
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
