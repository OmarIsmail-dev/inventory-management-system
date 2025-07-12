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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'refused', 'completed'])->default('pending');
            $table->unsignedBigInteger("user_id"); 
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("order_id"); 
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade")->onUpdate("cascade");

            $table->unsignedBigInteger('supplier_order_id');
            $table->foreign('supplier_order_id')->references('id')->on('supplier_orders')->onDelete('cascade')->onUpdate("cascade");
    
            $table->string("manager_name"); 
            //  $table->string("proof")->nullable();
            //  $table->string("image")->nullable();
            //  $table->text('problem')->nullable(); 
            $table->timestamps();
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
