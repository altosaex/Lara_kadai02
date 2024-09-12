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
		Schema::create('tweets', function (Blueprint $table) {
			$table->id();
			// 🔽 2カラム追加
			$table->foreignId('question_id')->constrained()->onDelete('cascade'); // 質問ID
			$table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID
			$table->string('tweet');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('tweets');
	}
};
