<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite enforces the enum as a CHECK constraint, which can't be altered in place.
        // Widen it by swapping in a plain string column with the same values preserved.
        Schema::table('users', function (Blueprint $table) {
            $table->string('role_new')->default('user')->after('role');
        });

        DB::statement('UPDATE users SET role_new = role');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('role_new', 'role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE users SET role = 'user' WHERE role = 'mitra'");

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role_old', ['user', 'admin'])->default('user')->after('role');
        });

        DB::statement('UPDATE users SET role_old = role');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('role_old', 'role');
        });
    }
};
