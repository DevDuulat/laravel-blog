@extends('layouts.app')
    @section('content')
        <div class="container mx-auto px-4 py-10">
            <h2 class="text-2xl font-bold text-center mb-6">Прохождение теста (Сохранённые вопросы)</h2>
                @livewire('saved-test-progress')
        </div>
@endsection
