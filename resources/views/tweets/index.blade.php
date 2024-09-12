<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Tweet一覧') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					@foreach ($tweets as $tweet)
					<div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
						<!-- 質問の内容を表示 -->
						<p class="text-gray-800 dark:text-gray-300">
							<strong>質問:</strong> {{ $tweet->question ? $tweet->question->question : '質問が存在しません' }}
						</p>
						<!-- ツイートの内容を表示 -->
						<p class="text-gray-800 dark:text-gray-300"><strong>回答:</strong> {{ $tweet->tweet }}</p>
						<!-- 投稿者の名前を表示 -->
						<p class="text-gray-600 dark:text-gray-400 text-sm">投稿者: {{ $tweet->user->name }}</p>
						<!-- 詳細リンク -->
						<a href="{{ route('tweets.show', $tweet) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
						{{-- いいね機能 --}}
						<div class="flex mt-2">
							@if ($tweet->liked->contains(auth()->id()))
							<form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="text-red-500 hover:text-red-700">❤️ {{ $tweet->liked->count() }}</button>
							</form>
							@else
							<form action="{{ route('tweets.like', $tweet) }}" method="POST">
								@csrf
								<button type="submit" class="text-blue-500 hover:text-blue-700">🤍 {{ $tweet->liked->count() }}</button>
							</form>
							@endif
						</div>
						{{-- コメント数とリンク --}}
						<div class="mt-4">
							<p class="text-gray-600 dark:text-gray-400 ml-4">コメント {{ $tweet->comments->count() }}</p>
							<a href="{{ route('tweets.show', $tweet) }}" class="text-blue-500 hover:text-blue-700 mr-2">コメントを見る</a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</x-app-layout>