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
        Schema::create('supplier_orders', function (Blueprint$table) { 

        $table->id();
        $table->timestamps();
        $table->string("supplier_name"); 
        $table->string("status")->default("pending"); 
        $table->string("email");
        $table->string("phone");
        $table->string("price");
        $table->string("TotalAmount"); 
        $table->integer("quantity");

        $table->string('brand')->default("unknown");
        $table->string('size_shoes')->nullable();
        $table->string('size_clothes')->nullable();
        $table->string('color');
        $table->text('description')->default("NotDescription");
        $table->date("date");
        $table->time("time"); 
        $table->unsignedBigInteger("user_id"); 
        $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
        $table->unsignedBigInteger("order_id")->nullable(); 
        $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade")->onUpdate("cascade");
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_orders');
    }
};
