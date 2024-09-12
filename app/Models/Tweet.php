<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
	use HasFactory;

	// protected $fillable = ['tweet'];
	protected $fillable = ['question_id', 'tweet', 'user_id'];

	// 🔽 追加
	public function question()
	{
		return $this->belongsTo(Question::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	// 🔽 追加
	public function liked()
	{
		return $this->belongsToMany(User::class)->withTimestamps();
	}
	// 🔽 1対多の関係
	public function comments()
	{
		return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
	}
}
