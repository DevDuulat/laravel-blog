@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p><strong>Автор:</strong> {{ $post->author->name ?? 'Неизвестный автор' }}</p>
        <p><strong>Опубликовано:</strong> {{ $post->published_at ? $post->published_at->format('d.m.Y') : 'Не опубликовано' }}</p>

        @if ($post->is_trend)
            <span class="badge badge-warning">🔥 Популярный пост</span>
        @endif

        <p>{{ $post->short_description }}</p>

        <div class="post-body">
            {!! $post->body !!}
        </div>

        <div class="post-meta" x-data="{ likes: {{ $post->likes }}, views: {{ $post->views }} }">
            <p><strong>Просмотры:</strong> <span x-text="views"></span></p>
            <p><strong>Лайки:</strong> <span x-text="likes"></span></p>
            <button @click="fetch('{{ route('post.like', $post->id) }}', {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}})
                .then(response => response.json())
                .then(data => likes = data.likes)"
                    class="btn btn-primary">👍 Лайк</button>
        </div>

        <hr>

        @livewire('post-comments', ['post' => $post])

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('post.incrementViews', $post->id) }}", { method: "POST", headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}" }})
                .then(response => response.json())
                .then(data => { document.querySelector("[x-data]").__x.$data.views = data.views; });
        });

    </script>

@endsection
