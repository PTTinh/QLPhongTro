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
        Schema::create('contract_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained('contracts'); // hợp đồng
            $table->foreignId('room_id')->constrained('rooms'); // phòng 
            $table->foreignId('id_lessee')->constrained('lessees'); // người thuê
            $table->boolean('is_signed')->default(false); // đã ký tên chưa
            $table->timestamp('signed_at')->nullable(); // thời gian ký
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_details');
    }
};
