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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_group_id')->nullable()->comment('イベントグループID');
            $table->string('title', 100)->comment('タイトル');
            $table->string('description', 1000)->comment('内容');
            $table->datetime('start_time')->comment('開始日時');
            $table->datetime('end_time')->comment('終了日時');
            $table->boolean('all_day_flag')->commeent('全日フラグ');
            $table->string('url', 200)->nullable()->comment('URL');
            $table->unsignedBigInteger('user_id')->comment('ユーザID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
