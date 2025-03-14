@extends('layouts.app')

@section('content')
    <section class="pt-30">
        <div class="container">
            <div class="flex flex-col md:flex-row justify-between gap-8">
                <div class="w-full md:w-2/3">
                    @foreach($posts as $post)
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <div
                                class="flex flex-col lg:flex-row bg-gray-200 p-6 transition-transform duration-200 ease-in-out hover:-translate-y-[5px]">
                                <div class="w-full h-50 lg:hidden block">
                                    <img src="{{ asset('storage/' . $post->cover) }}" alt=""
                                         class="object-cover w-full h-full"/>
                                </div>
                                <div class="flex flex-col gap-4">
                                    <h3 class="text-2xl font-semibold">{{ $post->title }}</h3>
                                    <p>{{ \Str::limit(strip_tags($post->content), 150) }}</p>
                                </div>
                                <div class="w-1/2 hidden lg:block">
                                    <img src="{{ asset('storage/' . $post->cover) }}" alt="">
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="w-1/3 hidden md:block">
                </div>
            </div>
        </div>
    </section>
@endsection
