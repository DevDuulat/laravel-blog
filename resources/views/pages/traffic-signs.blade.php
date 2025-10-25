@extends('layouts.app')

@section('content')
    <section class="relative z-10 pt-10">
        <div class="container mx-auto px-4 lg:px-16">
            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb" class="text-sm text-gray-600 mb-6">
                <ol class="flex items-center gap-2">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-gray-700 transition">Главная</a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li class="text-gray-500">Дорожные знаки</li>
                </ol>
            </nav>

            <!-- Grid of Cards -->
            <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($contents as $item)
                    @php
                        $title = $item->getTranslatedTitle();
                        $slug = $item->getTranslatedSlug();
                        $content = $item->getTranslatedContent();
                        $short = Str::limit(strip_tags($content), 100);
                    @endphp

                    @if ($slug)
                        <a href="{{ route('pages.show', ['slug' => $slug]) }}"
                           class="block bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                            <img src="{{ asset('storage/' . $item->cover) }}" alt="{{ $title }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $title }}</h3>
                                <p class="text-sm text-gray-600">{{ $short }}</p>
                            </div>
                        </a>
                    @endif
                @endforeach


            </div>
        </div>
    </section>
@endsection
