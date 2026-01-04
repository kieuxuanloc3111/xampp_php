<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {


            $table->id(); // auto increment, primary key

            $table->string('name');            
            $table->string('slug')->unique();     
            $table->text('description')->nullable(); 

            $table->integer('quantity');         
            $table->decimal('price', 10, 2);      
            $table->float('rating')->default(0); 

            $table->boolean('is_active')->default(true);

            $table->date('publish_date')->nullable();
            $table->dateTime('expired_at')->nullable();

            $table->json('extra_info')->nullable();

            $table->enum('status', ['draft', 'published', 'archived'])
                  ->default('draft');

            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete();

            $table->timestamps(); 

            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
