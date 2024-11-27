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
        Schema::create('lessees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); //tên khách hàng
            $table->string('phone')->unique()->nullable();; //số điện thoại
            $table->string('email')->nullable(); //email
            $table->string('address')->nullable(); //địa chỉ
            $table->string('job')->nullable(); // nghề nghiệp
            $table->date('dob')->nullable(); // ngày sinh
            $table->string('cccd_number')->unique(); // số cccd
            $table->string('cccd_front_image')->nullable(); // ảnh cccd mặt trước
            $table->string('cccd_back_image')->nullable(); // ảnh cccd mặt sau
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessees');
    }
};
