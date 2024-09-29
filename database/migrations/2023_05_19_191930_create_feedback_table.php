<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreign('id')->references('id')->on('pengaduans');
            $table->integer('update_user_by_id')->references('id')->on('users')->nullable();
            $table->enum('status', ['waiting', 'approved', 'rejected', 'process', 'pending', 'finished'])->default('waiting');
            $table->string('waiting_reason')->nullable();
            $table->datetime('waiting_updated_at')->nullable();
            $table->string('approved_reason')->nullable();
            $table->datetime('approved_updated_at')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->datetime('rejected_updated_at')->nullable();
            $table->string('process_reason')->nullable();
            $table->datetime('process_updated_at')->nullable();
            $table->string('pending_reason')->nullable();
            $table->datetime('pending_updated_at')->nullable();
            $table->string('finished_reason')->nullable();
            $table->datetime('finished_updated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
