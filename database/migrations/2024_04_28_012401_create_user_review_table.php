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
        Schema::create('user_review', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedTinyInteger('rating_value');
            $table->string('comment', 2000)->nullable();
            $table->timestamps();
            $table->softDeletes();

            /** Foreign key */
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->cascadeOnUpdate();
            $table->foreign('course_id')
                ->references('id')
                ->on('course')
                ->cascadeOnUpdate();

            /** Primary key */
            $table->primary(['user_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_review');
    }
};
