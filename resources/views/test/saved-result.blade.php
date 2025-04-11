@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-center mb-6">Результаты сохранённых вопросов</h2>

        @if(session('correctAnswers') !== null)
            <p class="text-lg text-center">
                Правильных ответов: <strong>{{ session('correctAnswers') }}</strong> из <strong>{{ session('totalQuestions') }}</strong>
            </p>
        @else
            <p class="text-center text-gray-500">Вы ещё не прошли тест.</p>
        @endif

        <div class="text-center mt-6">
            <a href="{{ route('test.savedProgress') }}" class="bg-blue-500 text-white px-5 py-3 rounded-lg hover:bg-blue-600">
                Пройти ещё раз
            </a>
        </div>
    </div>
@endsection
