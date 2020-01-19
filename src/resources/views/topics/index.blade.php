@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <a href="{{ route('topics.create') }}" class="btn btn-primary">
                投稿を新規作成する
            </a>
        </div>
        @foreach ($topics as $topic)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $topic->title }}
                    @if ($topic->user_id === Auth::id())
                        <span style="float: right;">Your</span>
                    @endif
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {!! nl2br(e(str_limit($topic->content, 600))) !!}
                    </p>
                    <a class="card-link" href="{{ route('topics.show', ['topic' => $topic]) }}">
                        続きを読む
                    </a>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $topic->created_at->format('Y.m.d') }}
                    </span>

                    @if ($topic->comments->count())
                        <span class="badge badge-primary">
                            コメント {{ $topic->comments->count() }}件
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center mb-5">
            {{ $topics->links() }}
        </div>
    </div>
@endsection