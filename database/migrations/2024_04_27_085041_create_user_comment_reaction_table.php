<?php

use App\Enums\ReactionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_comment_reaction', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comment_id');
            $table->enum('reaction_type', ReactionType::getValues());
            $table->timestamps();

            /** Foreign key */
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->cascadeOnUpdate();
            $table->foreign('comment_id')
                ->references('id')
                ->on('user_comment')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            /** Primary key */
            $table->primary(['user_id', 'comment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_comment_reaction');
    }
};
