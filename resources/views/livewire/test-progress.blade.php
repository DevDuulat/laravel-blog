<div wire:poll.1000ms>
    <div class="w-full max-w-[700px] mx-auto">
        <div class="flex flex-col items-center gap-4">
           <span>
                {{ __('messages.question_counter', ['current' => $currentQuestionIndex + 1, 'total' => $questions->count()]) }}
            </span>

            @php
                $progressPercent = $duration > 0 ? (int)(($timeLeft / $duration) * 100) : 0;
            @endphp

            <div class="w-full">
                <p class="text-xs font-medium text-gray-500 text-center">
                    {{ __('messages.time_left', ['time' => gmdate("i:s", $timeLeft)]) }}
                </p>


                <div class="mt-2 overflow-hidden rounded-full bg-gray-200 h-2 w-full">
                    <div
                        class="h-2 rounded-full bg-blue-500 transition-all duration-500"
                        style="width: {{ $progressPercent }}%;">
                    </div>
                </div>
            </div>

            <p class="text-lg font-medium text-center">{{ $question->question }}</p>

            @if($question->image)
                <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="mt-4 rounded-lg max-w-full">
            @endif

            <div class="space-y-2 w-full" wire:key="question-{{ $question->id }}">
                @foreach($question->answers as $answer)
                    <label class="flex cursor-pointer items-start gap-4 bg-white p-4 border rounded-lg hover:bg-gray-100 w-full">
                        <input
                            type="radio"
                            name="answer_{{ $question->id }}"
                            wire:model="selectedAnswer"
                            value="{{ $answer->id }}"
                            class="size-4 rounded-full mt-1"
                        >
                        <span>{{ $answer->answer }}</span>
                    </label>
                @endforeach
            </div>

            <button wire:click="submitAnswer"
                    class="mt-4 bg-orange-400 px-4 py-2 rounded-lg text-white hover:bg-orange-500">
                <p>{{ __('messages.to_answer') }}</p>
            </button>
        </div>
    </div>
</div>
