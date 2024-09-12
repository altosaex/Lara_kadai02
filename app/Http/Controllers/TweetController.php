<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Question;
use Illuminate\Http\Request;

class TweetController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		// 質問とのリレーションを読み込む
		$tweets = Tweet::with('question', 'user', 'liked', 'comments')->latest()->get();
		return view('tweets.index', compact('tweets'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		/// 🔽 追加
		$questions = Question::all();
		return view('tweets.create', compact('questions'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'question_id' => 'required|exists:questions,id',
			'tweet' => 'required|string|max:255',
		]);

		// ツイートの保存処理
		$request->user()->tweets()->create([
			'question_id' => $request->input('question_id'),
			'tweet' => $request->input('tweet'),
			'user_id' => auth()->id(), // ユーザーIDを保存する場合
		]);

		return redirect()->route('tweets.index')->with('success', 'Tweetが作成されました');

		// $request->user()->tweets()->create($request->only('tweet'));

		// return redirect()->route('tweets.index');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Tweet $tweet)
	{
		// Tweetと関連するQuestionを一緒に読み込む
		$tweet->load('question', 'user', 'liked', 'comments');
		return view('tweets.show', compact('tweet'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Tweet $tweet)
	{
		return view('tweets.edit', compact('tweet'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Tweet $tweet)
	{
		$request->validate([
			'tweet' => 'required|max:255',
		]);

		$tweet->update($request->only('tweet'));

		return redirect()->route('tweets.show', $tweet);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Tweet $tweet)
	{
		$tweet->delete();

		return redirect()->route('tweets.index');
	}
}
