<?php

namespace App\Livewire;

use Livewire\Component;

class TestResult extends Component
{
    public $correctAnswers;
    public $totalQuestions;
    public $test;

    public function mount($test, $correctAnswers, $totalQuestions)
    {
        $this->test = $test;
        $this->correctAnswers = $correctAnswers;
        $this->totalQuestions = $totalQuestions;
    }

    public function render()
    {
        return view('livewire.test-result');
    }
}
