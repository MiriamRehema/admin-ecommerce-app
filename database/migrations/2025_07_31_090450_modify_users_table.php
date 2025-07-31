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
             // Drop unnecessary columns
        $table->dropColumn(['role_id', 'username', 'active']);
        
        // Add email_verified_at column
        $table->timestamp('email_verified_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->bigInteger('role_id')->unsigned()->after('id');
        $table->string('username')->after('email');
        $table->boolean('active')->after('username');
        $table->dropColumn('email_verified_at'); // Drop the email_verified_at column
        });
    }
};
