<?php

use App\Enums\CourseStatus;
use App\Models\category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail_url', 2048);
            $table->string('course_name');
            $table->string('description');
            $table->unsignedFloat('price');
            $table->boolean('is_progress_limited');
            $table->unsignedSmallInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', CourseStatus::getValues())->default(CourseStatus::DRAFT);
            $table->timestamps();
            $table->softDeletes();

            /** Foreign key */
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->cascadeOnUpdate();
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->cascadeOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
