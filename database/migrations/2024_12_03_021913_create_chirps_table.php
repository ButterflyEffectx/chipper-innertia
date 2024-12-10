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
        Schema::create('chirps', function (Blueprint $table) {
            $table->id();
            #TODO: สร้างไอดีเป็น primary_key / auto_increment
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            #TODO: สร้างฟิลด์ user_id เชื่อมโยงกับตาราง users | constrained()->cascadeOnDelete() = ลบ chirps ทั้งหมดเมื่อผู้ใช้ถูกลบ
            $table->string('message');
            $table->timestamps();
            #TODO: เพิ่ม created_at และ updated_at
        });
    }

    /**
     * Reverse the migrations. TODO: func down() ใช้ลบสิ่งที่ถูกสร้างใน fucn up() ถ้าหากมี table 'chirps' อยู่แล้วจะ drop ทิ้ง
     */
    public function down(): void
    {
        Schema::dropIfExists('chirps');
    }
};
