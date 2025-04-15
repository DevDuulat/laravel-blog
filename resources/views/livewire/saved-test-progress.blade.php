<div class="flex flex-col gap-6 items-center">
    <div class="p-5 bg-gray-200 rounded-lg shadow-md w-full max-w-md text-center">
        <p class="text-lg font-semibold">{{ $question->question }}</p>

        @if($question->image)
            <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="mt-4 rounded-lg">
        @endif

        <div class="mt-4">
            @foreach($question->answers as $answer)
                <label class="flex cursor-pointer items-start gap-4 bg-white p-4 border rounded-lg hover:bg-gray-100">
                    <input type="checkbox" name="answers[{{ $question->id }}][]" value="{{ $answer->id }}" class="size-4 rounded-sm" wire:model="selectedAnswers">
                    <span>{{ $answer->answer }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="flex gap-4">
        <button wire:click="submitAnswer" class="bg-orange-400 px-5 py-3 rounded-lg text-white hover:bg-orange-500">
            Следующий вопрос
        </button>
    </div>
</div>
