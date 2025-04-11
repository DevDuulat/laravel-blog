@extends('layouts.app')

@section('content')
    <section class="relative z-10 pt-10">
        <div class="container mx-auto px-4 lg:px-16">
            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb" class="text-sm text-gray-600">
                <ol class="flex items-center gap-2">
                    <li>
                        <a href="{{ route('home') }}" class="transition hover:text-gray-700">Главная</a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}" class="transition hover:text-gray-700">Категория</a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li>
                        <a href="#" class="transition hover:text-gray-700">{{ $post->title }}</a>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="py-10 bg-white">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="space-y-6">
                <!-- Post Title -->
                <h2 class="text-3xl font-semibold text-gray-900">{{ $post->title }}</h2>

                <!-- Post Image -->
                <div class="w-full h-80 sm:h-96 overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}" class="w-full h-full object-cover object-center">
                </div>

                <!-- Post Metadata -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-gray-700">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">Дата публикации:</span>
                        <span class="text-sm text-white bg-blue-950 px-3 py-1 rounded-full">
                            {{ \Carbon\Carbon::parse($post->published_at)->format('d-m-Y') }}
                        </span>
                    </div>

                    <div>
                        <span class="font-medium text-gray-600">#{{ $post->meta_keywords }}</span>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="prose max-w-none text-gray-800 mt-6">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
