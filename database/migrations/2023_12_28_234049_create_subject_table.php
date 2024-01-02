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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('credits_no')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->integer('quantity_credits')->comment('Số tín chỉ');
            $table->integer('block')->default(1)->comment('So tiet tối thiểu lien tiep bat buoc, vi du Tin can 2 tiet');
            $table->boolean('avoid_first_lesson')->default(1)->comment('Tranh tiet cuoi cho 1 so mon the duc, toan, van');
            $table->boolean('require_spacing')->default(1)->comment('Tránh việc 2 ngày liên tiếp cùng học 1 môn');
            $table->boolean('require_class_room')->default(1)->comment('Là môn học cần phòng chỉ định');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
