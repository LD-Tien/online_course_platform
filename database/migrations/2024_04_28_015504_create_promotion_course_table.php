<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotion_course', function (Blueprint $table) {
            $table->unsignedBigInteger('promotion_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();

            /** Foreign key */
            $table->foreign('promotion_id')
                ->references('id')
                ->on('promotion')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('course_id')
                ->references('id')
                ->on('promotion')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            /** Primary key */
            $table->primary(['promotion_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_course');
    }
};
