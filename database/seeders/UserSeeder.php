<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// 🔽 2行追加
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// 🔽 3ユーザ作成する
		User::create([
			'name' => '月野うさぎ',
			'email' => 'usa@example.com',
			'password' => Hash::make('password'),
		]);
		User::create([
			'name' => '火野レイ',
			'email' => 'rei@example.com',
			'password' => Hash::make('password'),
		]);
		User::create([
			'name' => '水野亜美',
			'email' => 'ami@example.com',
			'password' => Hash::make('password'),
		]);
		User::create([
			'name' => '木野まこと',
			'email' => 'mako@example.com',
			'password' => Hash::make('password'),
		]);
		User::create([
			'name' => '愛野美奈子',
			'email' => 'mina@example.com',
			'password' => Hash::make('password'),
		]);
	}
}
