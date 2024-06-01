<?php

use App\Enums\LessonStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('video_path');
            $table->string('description', 4000);
            $table->unsignedTinyInteger('duration');
            $table->boolean('is_preview')->default(false);
            $table->tinyInteger('status')->default(LessonStatus::DRAFT);
            $table->smallInteger('ordinal_number');
            $table->unsignedBigInteger('module_id');
            $table->json('analysis_text_result_json')->nullable();
            $table->json('analysis_video_result_json')->nullable();
            $table->timestamps();

            /** Foreign key */
            $table->foreign('module_id')
                ->references('id')
                ->on('module')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson');
    }
};
