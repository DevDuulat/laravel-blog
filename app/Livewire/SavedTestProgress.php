<?php

namespace App\Livewire;

use App\Models\SavedQuestion;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SavedTestProgress extends Component
{
    public $savedQuestions;
    public $currentQuestionIndex = 0;
    public $selectedAnswers = [];


    public function mount()
    {
        $this->savedQuestions = SavedQuestion::where('user_id', auth()->id())
            ->with('question.answers')
            ->get()
            ->pluck('question');

        Session::forget('saved_test_answers');
    }

    public function submitAnswer()
    {
        $question = $this->savedQuestions[$this->currentQuestionIndex];

        $correctAnswers = $question->answers()->where('is_correct', true)->pluck('id')->toArray();

        $selected = array_map('intval', $this->selectedAnswers);
        $correctAnswers = array_map('intval', $correctAnswers);

        sort($selected);
        sort($correctAnswers);

        $isCorrect = ($selected === $correctAnswers);

        $answers = Session::get('saved_test_answers', []);
        $answers[$question->id] = [
            'question_id' => $question->id,
            'selected' => $selected,
            'correct' => $isCorrect
        ];
        Session::put('saved_test_answers', $answers);

        $this->selectedAnswers = [];

        $this->nextQuestion();
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < $this->savedQuestions->count() - 1) {
            $this->currentQuestionIndex++;
        } else {
            return $this->redirectToResults();
        }
    }

    private function redirectToResults()
    {
        $answers = Session::get('saved_test_answers', []);
        $correctCount = collect($answers)->where('correct', true)->count();
        $totalQuestions = $this->savedQuestions->count();

        return redirect()->route('test.savedResult', [
            'correctAnswers' => $correctCount,
            'totalQuestions' => $totalQuestions
        ]);
    }

    public function render()
    {
        return view('livewire.saved-test-progress', [
            'question' => $this->savedQuestions[$this->currentQuestionIndex]
        ]);
    }


}
