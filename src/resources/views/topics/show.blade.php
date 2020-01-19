@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            @if ($topic->user_id === Auth::id())
                <div class="mb-4 text-right">
                    <a class="btn btn-primary" href="{{ route('topics.edit', ['topic' => $topic]) }}">
                        編集する
                    </a>
                    <form style="display: inline-block;" method="POST" action="{{ route('topics.destroy', ['topic' => $topic]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">削除する</button>
                    </form>
                </div>
            @endif
            <h1 class="h5 mb-4">
                {{ $topic->title }}
            </h1>

            <p class="mb-5">
                {!! nl2br(e($topic->content)) !!}
            </p>
            <section>
                <h2 class="h5 mb-4">
                    コメント
                </h2>

                @forelse($topic->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>
        <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
            @csrf

            <input name="topic_id" type="hidden" value="{{ $topic->id }}">

            <div class="form-group">
                <label for="body">
                    本文
                </label>

                <textarea id="body" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="4">{{ old('body') }}</textarea>
                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('body') }}
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    コメントする
                </button>
            </div>
        </form>
        </div>
    </div>
@endsection