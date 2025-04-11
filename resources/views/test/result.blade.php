@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center gap-6 p-6 bg-gray-200 min-h-screen">

        <div class="flex flex-col items-center gap-4 mt-24">
            <h4 class="text-2xl font-semibold text-center">Результат теста</h4>
            <p class="text-lg text-center">Вы ответили правильно на <span class="font-bold">{{ $correctAnswers }}</span> из <span class="font-bold">{{ $totalQuestions }}</span> вопросов</p>
        </div>

        <div class="flex gap-6 items-center">
            <a href="{{ route('test.retry', ['testId' => $test->id]) }}" class="bg-orange-400 text-white px-6 py-3 rounded-lg font-semibold border border-orange-400 hover:bg-white hover:text-black transition duration-300 ease-in-out">
                Попробовать еще раз
            </a>

            <a href="{{ route('tests.index') }}" class="bg-orange-400 text-white px-6 py-3 rounded-lg font-semibold border border-orange-400 hover:bg-white hover:text-black transition duration-300 ease-in-out">
                Вернуться к темам
            </a>
        </div>
    </div>
@endsection
