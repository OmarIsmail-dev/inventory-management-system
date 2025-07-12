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
        Schema::create('orders', function (Blueprint $table) {
 
            $table->id();
 
             $table->string('email');
          $table->integer('quantity');
          $table->string('phone');
          $table->string('image')->nullable(); 
          $table->string("status")->default("pending"); 
          $table->string("Address");
          $table->string('brand')->default("unknown");
          $table->string('size_shoes')->nullable();
          $table->string('size_clothes')->nullable();
          $table->string('color'); 
          $table->text('description')->default("NotDescription");
          $table->unsignedBigInteger("product_id");
          $table->foreign('product_id')->references("id")->on('products')->onDelete('cascade');

 
          $table->unsignedBigInteger("user_id");
          $table->foreign('user_id')->references("id")->on('users')->onDelete('cascade');

          $table->timestamps();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
 