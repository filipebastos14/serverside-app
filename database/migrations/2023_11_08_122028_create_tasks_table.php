<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description') -> nullable();
            $table->date('due_at') -> nullable();
            $table->boolean('status') -> nullable();
            $table -> unsignedBigInteger('user_id'); // Isto é uma Foreign key e é assim que o criámos
            $table -> foreign('user_id') -> references('id') -> on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
