<?php

namespace App\Livewire;

use App\Models\Test;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class TestProgress extends Component
{
    public $test;
    public $questions;
    public $currentQuestionIndex = 0;
    public $selectedAnswers = [];

    public function mount(Test $test)
    {
        $this->test = $test;
        $this->questions = $test->questions()->with('answers')->get();
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < $this->questions->count() - 1) {
            $this->currentQuestionIndex++;
        } else {
            return redirect()->route('test.result', ['testId' => $this->test->id]);

        }
    }

    public function submitAnswer()
    {
        $question = $this->questions[$this->currentQuestionIndex];

        $correctAnswers = $question->answers()->where('is_correct', true)->pluck('id')->toArray();

        $isCorrect = empty(array_diff($this->selectedAnswers, $correctAnswers)) &&
            empty(array_diff($correctAnswers, $this->selectedAnswers));

        Session::push('test_answers', [
            'question_id' => $question->id,
            'selected' => $this->selectedAnswers,
            'correct' => $isCorrect
        ]);

        $this->selectedAnswers = [];

        $this->nextQuestion();
    }

    public function render()
    {
        return view('livewire.test-progress', [
            'question' => $this->questions[$this->currentQuestionIndex]
        ]);
    }

}
