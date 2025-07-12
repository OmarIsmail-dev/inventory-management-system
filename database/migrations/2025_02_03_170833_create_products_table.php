<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('image')->nullable();
            $table->integer('in_stock');
            $table->string('BuyingPrice');
            $table->string('SellingPrice'); 
            $table->text('description')->default("NotDescription");
            $table->string('brand')->default("unknown");
            $table->string('size_shoes')->nullable();
            $table->string('size_clothes')->nullable();
            $table->string('color'); 
            $table->string('product_type')->nullable();
            $table->string('product_attribute_name')->nullable();
            $table->string('product_attribute_value');
            $table->boolean('is_active_model')->default(false); 
            $table->timestamp('last_sold_at')->nullable(); 
            $table->unsignedBigInteger("category_id");
            $table->foreign('category_id')->references("id")->on('categories')->onDelete('cascade');




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
