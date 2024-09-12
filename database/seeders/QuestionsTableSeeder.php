<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('questions')->insert([
			['question' => 'Q.一番好きな食べ物は？'],
			['question' => 'Q.子供の頃のあだ名は？'],
			['question' => 'Q.どんな時に楽しいと感じる？'],
			['question' => 'Q.自分を漢字一文字で表すと？'],
			// 必要に応じて他の質問も追加できます
		]);
	}
}
