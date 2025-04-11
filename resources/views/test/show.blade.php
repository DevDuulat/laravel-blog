@extends('layouts.app')

@section('content')
    <main class="flex-grow">
        <section class="py-10">
            <div class="container mx-auto px-4">
                <div class="flex flex-col items-center gap-6">

                    <div class="flex flex-col gap-4 w-full lg:max-w-[1200px] bg-gray-200 p-5 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold text-center mb-4">{{ $test->title }}</h2>

                        @livewire('test-progress', ['test' => $test])
                    </div>

                    @auth
{{--                        @livewire('save-question', ['questionId' => $question->id])--}}
                    @endauth

                </div>
            </div>
        </section>
    </main>
@endsection
