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
        Schema::create('fastspring_users', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->index();
            $table->string('user_id')->index();
            $table->string('fullname');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->boolean('subscribed')->default(true);
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('lang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fastspring_users');
    }
};
