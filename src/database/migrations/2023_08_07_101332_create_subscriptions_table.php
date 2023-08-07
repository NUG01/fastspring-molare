<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subscription_id');
            $table->string('order_reference');
            $table->unsignedInteger('user_id');
            $table->string('fastspring_account_id');
            $table->string('fastspring_id');
            $table->string('plan');
            $table->boolean('active')->default(true);
            $table->string('interval_type')->default('month');
            $table->string('currency');
            $table->datetime('ends_at')->default(now()->addDays(30));
            $table->datetime('cancelled_at')->nullable();
            $table->datetime('paused_at')->nullable();
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
