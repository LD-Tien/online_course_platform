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
            $table->string('video_url', 2048);
            $table->string('description', 4000);
            $table->boolean('is_preview')->default(false);
            $table->enum('status', LessonStatus::getValues())->default(LessonStatus::DRAFT);
            $table->smallInteger('ordinal_number');
            $table->unsignedBigInteger('module_id');
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
