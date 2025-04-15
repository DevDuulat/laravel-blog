@extends('layouts.app')

@section('content')
    <section class="relative z-10 pt-10">
        <div class="container mx-auto px-4 lg:px-16">
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
                        <a href="#" class="transition hover:text-gray-700">{{ $page->title }}</a>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="py-10 bg-white">
        <div class="container mx-auto px-4 lg:px-16">
            <div class="flex flex-col lg:flex-row gap-6">

                {{-- Левая реклама --}}
                <aside class="hidden lg:block w-1/5">
                    <div class="sticky top-20 space-y-4">
                        <div class="bg-gray-100 p-4 rounded-lg shadow text-sm text-gray-700">
                            <p>{{ __('messages.advertisement') }}</p>
                            <img src="https://placehold.co/600x400/EEE/31343C" alt="Ad" class="mt-2 rounded">
                        </div>
                    </div>
                </aside>

                {{-- Контент страницы --}}
                <article class="w-full lg:w-3/5 space-y-6">
                    <h2 class="text-3xl font-semibold text-gray-900">{{ $page->title }}</h2>

                    @if ($page->cover)
                        <div class="w-full h-80 sm:h-96 overflow-hidden rounded-lg shadow-md">
                            <img src="{{ asset('storage/' . $page->cover) }}" alt="{{ $page->title }}" class="w-full h-full object-cover object-center">
                        </div>
                    @endif

                    <div class="prose max-w-none text-gray-800 mt-6">
                        {!! $page->content !!}
                    </div>
                </article>

                {{-- Правая реклама --}}
                <aside class="hidden lg:block w-1/5">
                    <div class="sticky top-20 space-y-4">
                        <div class="bg-gray-100 p-4 rounded-lg shadow text-sm text-gray-700">
                            <p>{{ __('messages.advertisement') }}</p>
                            <img src="https://placehold.co/600x400/EEE/31343C" alt="Ad" class="mt-2 rounded">
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>
@endsection
