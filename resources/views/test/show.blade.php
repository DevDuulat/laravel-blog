@extends('layouts.app')

@section('content')
    <main class="flex-grow">
        <section class="py-10 bg-white">
            <div class="container mx-auto px-4 lg:px-16">
                <div class="flex flex-col lg:flex-row lg:items-start gap-6">

                    {{-- Левая реклама --}}
                    <aside class="hidden lg:block w-1/5">
                        <div class="sticky top-20 space-y-4">
                            <div class="bg-gray-100 p-4 rounded-lg shadow text-sm text-gray-700">
                                <p>{{ __('messages.advertisement') }}</p>
                                <img src="https://placehold.co/600x400/EEE/31343C" alt="Ad Left" class="rounded">
                            </div>
                        </div>
                    </aside>

                    {{-- Контент теста --}}
                    <div class="flex-1 flex flex-col items-center gap-6">
                        <div class="w-full max-w-[700px] bg-gray-200 p-5 rounded-lg shadow-md">
                            <h2 class="text-2xl font-bold text-center mb-4">{{ $test->title }}</h2>

                            @livewire('test-progress', ['test' => $test])
                        </div>

                        @auth
                            {{-- @livewire('save-question', ['questionId' => $question->id]) --}}
                        @endauth
                    </div>

                    {{-- Правая реклама --}}
                    <aside class="hidden lg:block w-1/5">
                        <div class="sticky top-20 space-y-4">
                            <div class="bg-gray-100 p-4 rounded-lg shadow text-sm text-gray-700">
                                <p>{{ __('messages.advertisement') }}</p>
                                <img src="https://placehold.co/600x400/EEE/31343C" alt="Ad Right" class="rounded">
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </section>

    </main>
@endsection
