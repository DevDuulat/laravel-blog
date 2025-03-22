<div class="flex flex-col items-center justify-center gap-6 p-5 bg-gray-200">
    <img src="img/010-1.jpg" alt="" class="w-100" />

    <div class="flex flex-col items-center gap-4">
        <h4 class="text-xl">Результат теста</h4>
        <p class="text-lg">Вы ответили правильно на <span class="font-bold">{{ $correctAnswers }}</span> из <span class="font-bold">{{ $totalQuestions }}</span> вопросов</p>
    </div>

    <div class="flex gap-4 items-center">
        <a href="{{ route('test.retry', ['testId' => $test->id]) }}" class="bg-orange-400 px-3 py-2 rounded-lg text-white border border-orange-400 hover:bg-white hover:text-black ">Попробовать еще раз</a>
        <a href="{{ route('categories.index') }}" class="bg-orange-400 px-3 py-2 rounded-lg text-white border border-orange-400 hover:bg-white hover:text-black ">Вернуться к темам</a>
    </div>

</div>
