<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_notification_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained('notifications');
            $table->foreignId('category_id')->constrained('notification_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_notification_categories');
    }
};
