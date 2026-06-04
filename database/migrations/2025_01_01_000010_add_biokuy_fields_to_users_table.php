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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->text('bio')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('bio');
            $table->string('theme')->default('default')->after('avatar');
            $table->enum('plan', ['free', 'student', 'pro'])->default('free')->after('theme');
            $table->string('custom_url')->unique()->nullable()->after('plan');
            $table->boolean('is_active')->default(true)->after('custom_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropUnique(['custom_url']);
            $table->dropColumn([
                'username',
                'bio',
                'avatar',
                'theme',
                'plan',
                'custom_url',
                'is_active',
            ]);
        });
    }
};
