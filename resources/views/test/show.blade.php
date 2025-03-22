@extends('layouts.app')

@section('content')
    <main class="flex-grow">
        <section class="py-30">
            <div class="container">
                <div class="flex flex-col items-center gap-4">
                    <img src="{{ asset('img/v1.png') }}" alt="">

                    <div class="flex flex-col gap-4 lg:w-220 w-full bg-gray-200 p-5">
                        <h2 class="text-2xl font-bold text-center mb-4">{{ $test->title }}</h2>

                        @livewire('test-progress', ['test' => $test])
                    </div>

                    <a href="#" class="bg-orange-400 px-3 py-2 rounded-lg text-white border border-orange-400 hover:bg-white hover:text-black lg:ml-180">Сохранить вопрос</a>
                </div>
            </div>
        </section>
    </main>
@endsection
