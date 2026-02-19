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
     Schema::table('todos', function (Blueprint $table) {
        $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
        $table->unsignedBigInteger('project_id')->nullable()->after('user_id');
        $table->unsignedBigInteger('assigned_to')->nullable()->after('project_id');
        $table->enum('status', ['todo', 'in Progress', 'done'])->default('todo');
     });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'project_id', 'assigned_to', 'status']);
        });
    }
};
