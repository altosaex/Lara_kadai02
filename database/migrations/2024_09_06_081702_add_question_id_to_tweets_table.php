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
		Schema::table('tweets', function (Blueprint $table) {
			$table->unsignedBigInteger('question_id')->after('user_id');
			// 既存のレコードにはデフォルト値を設定する場合
			$table->foreign('question_id')->references('id')->on('questions');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('tweets', function (Blueprint $table) {
			$table->dropForeign(['question_id']);
			$table->dropColumn('question_id');
		});
	}
};
