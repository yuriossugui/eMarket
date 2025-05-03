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
            $table->string('name')->unique();
            $table->string('description')->unique();
            $table->integer('stock');
            $table->decimal('price',8,2);
            $table->string('image');
            $table->unsignedBigInteger('category_id')->nullable(); // Cria a coluna 'category_id' como um inteiro não negativo e permite nulos
            $table->foreign('category_id')
            ->references('id')
            ->on('categories') // <-- aqui estava faltando
            ->onDelete('SET NULL');      
            $table->softDeletes();
            $table->timestamps();
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
