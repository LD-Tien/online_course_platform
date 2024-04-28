<?php

use App\Enums\RefundRequestStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('refund_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_item_id');
            $table->string('reason', 2000);
            $table->enum('status', RefundRequestStatus::getValues())
                ->default(RefundRequestStatus::PENDING);
            $table->timestamps();

            /** Foreign key */
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->cascadeOnUpdate();
            $table->foreign('order_item_id')
                ->references('id')
                ->on('order_item')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_request');
    }
};
