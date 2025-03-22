<div>
    <div class="flex flex-col items-center gap-4">
        <span>Вопрос {{ $currentQuestionIndex + 1 }} из {{ $questions->count() }}</span>
        <p>{{ $question->question }}</p>
        @if($question->image)
            <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="mt-4 rounded-lg">
        @endif
        <div class="space-y-2">
            @foreach($question->answers as $answer)
                <label class="flex cursor-pointer items-start gap-4 bg-white p-4 border rounded-lg hover:bg-gray-100">
                    <input type="checkbox" wire:model="selectedAnswers" value="{{ $answer->id }}" class="size-4 rounded-sm">
                    <span>{{ $answer->answer }}</span>
                </label>
            @endforeach
        </div>

        <button wire:click="submitAnswer" class="mt-4 bg-orange-400 px-3 py-2 rounded-lg text-white hover:bg-orange-500">
            Ответить
        </button>
    </div>
</div>
