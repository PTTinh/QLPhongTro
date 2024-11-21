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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); //tên phòng
            $table->float('area')->nullable(); //diện tích
            $table->float('usable_area')->nullable(); //diện tích sử dụng
            $table->text('description')->nullable(); //mô tả
            $table->integer('capacity')->nullable(); //số người
            $table->decimal('price', 22, 2); //giá
            $table->string('photo')->nullable(); //ảnh
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
