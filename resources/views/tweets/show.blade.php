<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Tweet詳細') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					<a href="{{ route('tweets.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">一覧に戻る</a>

					<!-- 質問の内容を表示 -->
					<p class="text-gray-800 dark:text-gray-300 text-lg">
						<strong>質問:</strong> {{ $tweet->question ? $tweet->question->question : '質問が存在しません' }}
					</p>

					<!-- ツイートの内容を表示 -->
					<p class="text-gray-800 dark:text-gray-300 text-lg">{{ $tweet->tweet }}</p>

					<!-- 投稿者の名前を表示 -->
					<p class="text-gray-600 dark:text-gray-400 text-sm">投稿者: {{ $tweet->user->name }}</p>

					<!-- 作成日時と更新日時を表示 -->
					<div class="text-gray-600 dark:text-gray-400 text-sm">
						<p>作成日時: {{ $tweet->created_at->format('Y-m-d H:i') }}</p>
						<p>更新日時: {{ $tweet->updated_at->format('Y-m-d H:i') }}</p>
					</div>

					<!-- 編集と削除のリンク（投稿者のみ） -->
					@if (auth()->id() == $tweet->user_id)
					<div class="flex mt-4">
						<a href="{{ route('tweets.edit', $tweet) }}" class="text-blue-500 hover:text-blue-700 mr-2">編集</a>
						<form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
							@csrf
							@method('DELETE')
							<button type="submit" class="text-red-500 hover:text-red-700">削除</button>
						</form>
					</div>
					@endif

					<!-- いいねボタン -->
					<div class="flex mt-4">
						@if ($tweet->liked->contains(auth()->id()))
						<form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
							@csrf
							@method('DELETE')
							<button type="submit" class="text-red-500 hover:text-red-700">❤️ {{$tweet->liked->count()}}</button>
						</form>
						@else
						<form action="{{ route('tweets.like', $tweet) }}" method="POST">
							@csrf
							<button type="submit" class="text-blue-500 hover:text-blue-700">🤍 {{$tweet->liked->count()}}</button>
						</form>
						@endif
					</div>

					<!-- コメント数とコメント追加リンク -->
					<div class="mt-4">
						<p class="text-gray-600 dark:text-gray-400 ml-4">コメント {{ $tweet->comments->count() }}</p>
						<a href="{{ route('tweets.comments.create', $tweet) }}" class="text-blue-500 hover:text-blue-700 mr-2">コメントする</a>
					</div>

					<!-- コメント一覧 -->
					<div class="mt-4">
						@foreach ($tweet->comments as $comment)
						<a href="{{ route('tweets.comments.show', [$tweet, $comment]) }}">
							<p>{{ $comment->comment }} <span class="text-gray-600 dark:text-gray-400 text-sm">{{ $comment->user->name }} {{ $comment->created_at->format('Y-m-d H:i') }}</span></p>
						</a>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>