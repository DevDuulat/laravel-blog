@extends('layouts.app')

@section('content')
    <section class="relative mt-20 sm:mb-0 bg-gradient-to-b from-white to-gray-50 py-12 sm:py-20">
        <div class="container mx-auto px-4 lg:px-8 xl:px-16 flex flex-col sm:flex-row items-center justify-between gap-8 sm:gap-12">
            <div class="text-center sm:text-start flex flex-col gap-6 max-w-2xl">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-900 leading-tight">
                    {{ __('messages.test_your_knowledge') }}
                    <br>
                    <span class="text-orange-500">{{ __('messages.pdd') }}</span> {{ __('messages.online') }}
                </h1>

                <p class="text-lg sm:text-xl text-gray-600 leading-relaxed">
                    {{ __('messages.description_pdd_platform') }}
                </p>

                <div class="flex flex-col sm:flex-row justify-center sm:justify-start gap-4 mt-4">
                    <a href="{{ route('tests.index') }}"
                       class="px-6 py-3 sm:px-8 sm:py-4 text-white font-semibold bg-orange-500 hover:bg-orange-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        {{ __('messages.start_test') }}
                    </a>

                    <a href="{{ route('posts.index') }}"
                       class="px-6 py-3 sm:px-8 sm:py-4 text-gray-700 font-semibold bg-white border border-gray-200 hover:border-orange-500 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                        </svg>
                        {{ __('messages.read_blog') }}
                    </a>
                </div>

                <div class="mt-4 flex flex-wrap justify-center sm:justify-start gap-3 text-sm text-gray-500">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ __('messages.actual_tickets') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ __('messages.detailed_explanations') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ __('messages.questions_count') }}
                    </div>
                </div>
            </div>

            <div class="hidden sm:block relative max-w-xl xl:max-w-2xl">
                <img src="{{ asset('img/car.png') }}" alt="Автомобиль и дорожные знаки" class="w-full h-auto transform hover:scale-105 transition-transform duration-500"/>

                <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            </div>
        </div>
    </section>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
    </style>

    <section class="py-20 bg-gray-100">
        <div class="container mx-auto px-4 lg:px-16">
            <h2 class="text-center text-3xl font-bold mb-12 text-gray-800">ПДД КР 2025</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="flex flex-col justify-between h-full p-6 bg-white rounded-2xl shadow-lg transition duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col gap-3">
                        <h3 class="text-lg font-bold text-gray-900">{{ __('messages.pdd_2024_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ __('messages.pdd_2024_desc') }}</p>
                    </div>
                    <a href="{{ route('pages.show', 'pdd-kr-2024') }}"
                       class="mt-6 inline-block text-center px-5 py-2 font-medium text-white bg-orange-500 rounded-xl hover:bg-orange-600 transition">
                        {{ __('messages.read') }}
                    </a>
                </div>

                <div class="flex flex-col justify-between h-full p-6 bg-white rounded-2xl shadow-lg transition duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col gap-3">
                        <h3 class="text-lg font-bold text-gray-900">{{ __('messages.traffic_signs_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ __('messages.traffic_signs_title') }}</p>
                    </div>
                    <a href="{{ route('traffic.signs') }}"
                       class="mt-6 inline-block text-center px-5 py-2 font-medium text-white bg-orange-500 rounded-xl hover:bg-orange-600 transition">
                        {{ __('messages.read') }}
                    </a>
                </div>


                <div class="flex flex-col justify-between h-full p-6 bg-white rounded-2xl shadow-lg transition duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col gap-3">
                        <h3 class="text-lg font-bold text-gray-900">{{ __('messages.road_markings_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ __('messages.road_markings_desc') }}</p>
                    </div>
                    <a href="{{ route('road.markings') }}"
                       class="mt-6 inline-block text-center px-5 py-2 font-medium text-white bg-orange-500 rounded-xl hover:bg-orange-600 transition">
                        {{ __('messages.read') }}
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 lg:px-16">
            <h3 class="text-center text-3xl font-bold mb-12 text-gray-800">{{ __('messages.news_blog')}}</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <div class="flex flex-col justify-between border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                        <div>
                            @if($post->cover)
                                <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}"
                                     class="w-full h-44 object-cover rounded mb-3">
                            @endif

                            <h4 class="text-lg font-semibold text-gray-900 mb-2 leading-snug">
                                {{ $post->title }}

                            </h4>

                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100, '...') }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-4 text-sm text-gray-500">
                            <span>{{ \Carbon\Carbon::parse($post->published_at)->format('d.m.Y') }}</span>
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-orange-500 hover:underline font-medium">
                                {{ __('messages.read') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- CTA блок -->
            <div class="mt-16 text-center bg-orange-400 text-white py-10 rounded-lg shadow-md">
                <h4 class="text-2xl font-semibold mb-4">{{ __('messages.want_news_first') }}</h4>
                <p class="text-lg mb-6">{{ __('messages.subscribe_newsletter_text') }}</p>
                <a href=""
                   class="px-6 py-3 bg-white text-orange-500 font-semibold rounded-lg hover:bg-gray-200 transition">
                    {{ __('messages.subscribe') }}
                </a>
            </div>

            <div class="flex justify-center mt-12">
                <a href="{{ route('posts.index') }}"
                   class="text-sm text-orange-500 hover:underline font-medium">
                    {{ __('messages.view_all_articles') }}
                </a>
            </div>
        </div>
    </section>



    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-16 flex flex-col items-center">
            <h3 class="text-center text-3xl font-semibold mb-8 text-gray-800">Справка FAQ</h3>

            <div class="w-full lg:w-3/4 space-y-4">
                @foreach($faqs as $faq)
                    <details class="group bg-white rounded-lg shadow-md overflow-hidden">
                        <summary class="flex justify-between items-center p-4 cursor-pointer text-gray-800 hover:bg-gray-100 transition-all">
                            <h4 class="font-medium text-lg">{{ $faq->question }}</h4>
                            <svg class="size-5 shrink-0 transition duration-300 group-open:-rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <p class="p-4 text-gray-700">{!! nl2br(e($faq->answer)) !!}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>


@endsection
