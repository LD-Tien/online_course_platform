<?php

use App\Enums\OrderItemStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedFloat('price');
            $table->enum('status', OrderItemStatus::getValues())
                ->default(OrderItemStatus::PAID);
            $table->timestamps();

            /** Foreign key */
            $table->foreign('order_id')
                ->references('id')
                ->on('order')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('course_id')
                ->references('id')
                ->on('course')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
};
