<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'question' => 'required|string|max:255',
		]);

		$question = Question::create([
			'question' => $request->input('question'),
		]);

		return response()->json($question, 201);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, $id)
	{
		$request->validate([
			'question' => 'required|string|max:255', // 更新するフィールドのバリデーション
		]);

		$question = Question::findOrFail($id); // IDで質問を取得

		$question->update($request->only('question')); // 質問の内容を更新

		return response()->json($question);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id)
	{
		$question = Question::findOrFail($id);
		$question->delete();

		return response()->json(['message' => 'Question deleted successfully']);
	}
}
