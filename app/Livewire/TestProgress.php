<?php
namespace App\Livewire;

use App\Models\Mistake;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Carbon\Carbon;

class TestProgress extends Component
{
    public $test;
    public $questions;
    public $currentQuestionIndex = 0;
    public $selectedAnswer = null;

    public $startTime;
    public $duration;
    public $timeLeft;

    public function mount(Test $test)
    {
        $this->test = $test;
        $this->questions = $test->questions()->with('answers')->get();
        $this->duration = $test->duration * 60;
        $this->startTime = now();
        $this->timeLeft = $this->duration;

        Session::forget('test_answers');
    }

    public function hydrate()
    {
        $this->updateTimeLeft();
    }

    public function updateTimeLeft()
    {
        $elapsed = now()->diffInSeconds($this->startTime);
        $this->timeLeft = max(0, $this->duration - $elapsed);

        if ($this->timeLeft <= 0) {
            $this->handleTimeout();
        }
    }

    public function submitAnswer()
    {
        $this->updateTimeLeft();

        if ($this->timeLeft <= 0) return;

        $question = $this->questions[$this->currentQuestionIndex];
        $correctAnswer = $question->answers()->where('is_correct', true)->first();

        $isCorrect = $correctAnswer && $this->selectedAnswer == $correctAnswer->id;

        $answers = Session::get('test_answers', []);
        $answers[$question->id] = [
            'question_id' => $question->id,
            'selected' => $this->selectedAnswer,
            'correct' => $isCorrect
        ];
        Session::put('test_answers', $answers);

        if (!$isCorrect && Auth::check()) {
            Mistake::firstOrCreate([
                'user_id' => Auth::id(),
                'question_id' => $question->id
            ]);
        }

        $this->selectedAnswer = null;
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

    public function handleTimeout()
    {
        $answers = Session::get('test_answers', []);

        for ($i = $this->currentQuestionIndex; $i < $this->questions->count(); $i++) {
            $question = $this->questions[$i];

            $answers[$question->id] = [
                'question_id' => $question->id,
                'selected' => null,
                'correct' => false
            ];

            if (Auth::check()) {
                Mistake::firstOrCreate([
                    'user_id' => Auth::id(),
                    'question_id' => $question->id
                ]);
            }
        }

        Session::put('test_answers', $answers);

        return $this->redirectToResults(true);
    }

    private function redirectToResults($timeExpired = false)
    {
        $answers = Session::get('test_answers', []);
        $correctCount = collect($answers)->where('correct', true)->count();
        $totalQuestions = $this->questions->count();
        $timeSpent = $this->duration - $this->timeLeft;

        if (Auth::check()) {
            TestResult::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'test_id' => $this->test->id,
                ],
                [
                    'score' => $correctCount,
                    'total' => $totalQuestions,
                    'duration' => $timeSpent,
                    'completed' => true,
                    'time_expired' => $timeExpired
                ]
            );
        }

        return redirect()->route('test.result', [
            'testId' => $this->test->id,
            'correctAnswers' => $correctCount,
            'totalQuestions' => $totalQuestions,
            'timeSpent' => $timeSpent
        ]);
    }
    #[On('updateTime')]
    public function updateTime() {
        $this->updateTimeLeft();
    }


    public function render()
    {
        $this->updateTimeLeft();

        return view('livewire.test-progress', [
            'question' => $this->questions[$this->currentQuestionIndex],
            'timeLeft' => $this->timeLeft,
            'duration' => $this->duration,
        ]);

    }
}
