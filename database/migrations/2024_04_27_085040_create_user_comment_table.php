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
        Schema::create('user_comment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_comment_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('quiz_id')->nullable();
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->string('content', 4000);
            $table->timestamps();
            $table->softDeletes();

            /** Foreign key */
            $table->foreign('parent_comment_id')
                ->references('id')
                ->on('user_comment')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->cascadeOnUpdate();
            $table->foreign('lesson_id')
                ->references('id')
                ->on('lesson')
                ->cascadeOnUpdate();
            $table->foreign('quiz_id')
                ->references('id')
                ->on('quiz')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_comment');
    }
};
