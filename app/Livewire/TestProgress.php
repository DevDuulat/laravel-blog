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
        Session::forget('test_answers');
    }

    public function submitAnswer()
    {
        $question = $this->questions[$this->currentQuestionIndex];

        $correctAnswers = $question->answers()->where('is_correct', true)->pluck('id')->toArray();

        $selected = array_map('intval', $this->selectedAnswers);
        $correctAnswers = array_map('intval', $correctAnswers);

        sort($selected);
        sort($correctAnswers);

        $isCorrect = ($selected === $correctAnswers);

        $answers = Session::get('test_answers', []);
        $answers[$question->id] = [
            'question_id' => $question->id,
            'selected' => $selected,
            'correct' => $isCorrect
        ];
        Session::put('test_answers', $answers);

        $this->selectedAnswers = [];

        $this->nextQuestion();
    }


    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < $this->questions->count() - 1) {
            $this->currentQuestionIndex++;
        } else {
            return $this->redirectToResults();
        }
    }

    private function redirectToResults()
    {
        $answers = Session::get('test_answers', []);
        $correctCount = collect($answers)->where('correct', true)->count();
        $totalQuestions = $this->questions->count();

        return redirect()->route('test.result', [
            'testId' => $this->test->id,
            'correctAnswers' => $correctCount,
            'totalQuestions' => $totalQuestions
        ]);
    }

    public function render()
    {
        return view('livewire.test-progress', [
            'question' => $this->questions[$this->currentQuestionIndex]
        ]);
    }
}

