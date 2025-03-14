@extends('layouts.app')

@section('content')
    <section class="pt-30 ">
        <div class="container">
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center gap-1 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('home') }}" class="block transition hover:text-gray-700">
                            <span class=""> Главная  </span>
                        </a>
                    </li>

                    <li class="rtl:rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>

                    <li>
                        <a href="{{ route('posts.index') }}" class="block transition hover:text-gray-700"> Категория </a>
                    </li>

                    <li class="rtl:rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>

                    <li>
                        <a href="" class="block transition hover:text-gray-700">{{ $post->title }}</a>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="py-10">
        <div class="container">
            <div class="flex flex-col gap-6">
                <div>
                    <h2 class="text-2xl">{{ $post->title }}</h2>
                </div>
                <div class="w-full sm:h-120 ">
                    <img src="{{ asset('storage/' . $post->cover) }}" alt="" class="sm:w-full sm:h-full sm:object-cover sm:object-center">
                </div>
                <div class="flex items-center flex-wrap sm:flex-nowrap gap-6 sm:gap-2 ">
                    <div class="flex items-center gap-4">
                        <span class="font-semibold">Дата публикации: </span>
                        <span class="text-sm text-white bg-blue-950 px-2 py-1 rounded-full">
    Опубликовано: {{ \Carbon\Carbon::parse($post->published_at)->format('d-m-Y') }}
</span>

                    </div>

                    <div class="sm:ml-auto">
                        <span>#{{ $post->meta_keywords }}</span>
                    </div>
                </div>

                <div class="prose max-w-none">
                    {!! $post->content !!}
                </div>


            </div>
        </div>
    </section>

@endsection
