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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->date('created_date')->nullable(); // ngày tạo
            $table->date('start_date')->nullable(); // ngày bắt đầu
            $table->date('end_date')->nullable(); // ngày kết thúc
            $table->integer('month')->nullable(); // tháng
            $table->integer('price_eletric')->nullable(); // giá điện
            $table->integer('price_water')->nullable(); // giá nước
            $table->integer('other_fees')->nullable(); // các khoản phụ thu khác
            $table->foreignId('created_by')->constrained('users'); // người tạo hợp đồng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
