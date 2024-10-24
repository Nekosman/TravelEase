<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add notification columns with default values
            $table->boolean('email_notifications')->default(true)->after('email');
            $table->boolean('push_notifications')->default(false)->after('email_notifications');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns if this migration is rolled back
            $table->dropColumn(['email_notifications', 'push_notifications']);
        });
    }
}
