<?php

use App\Enums\QuizStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('name', 500);
            $table->string('description', 4000);
            $table->unsignedTinyInteger('min_pass_score')->default(0);
            $table->boolean('is_required')->default(false);
            $table->tinyInteger('status')->default(QuizStatus::DRAFT);
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
        Schema::dropIfExists('quiz');
    }
};
