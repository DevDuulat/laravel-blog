<?php

namespace App\Livewire;

use App\Models\Test;
use Livewire\Component;

class TestResult extends Component
{
    public $correctAnswers;
    public $totalQuestions;
    public $test;

    public function mount($testId, $correctAnswers, $totalQuestions)
    {
        $this->test = Test::findOrFail($testId);
        $this->correctAnswers = $correctAnswers;
        $this->totalQuestions = $totalQuestions;
    }

    public function render()
    {
        return view('livewire.test-result', [
            'correctAnswers' => $this->correctAnswers,
            'totalQuestions' => $this->totalQuestions,
        ]);
    }
}


