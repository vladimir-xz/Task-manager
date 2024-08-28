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
        Schema::table('tasks', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('task_comments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('task_comment_user', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('task_comments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('task_comment_user', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
