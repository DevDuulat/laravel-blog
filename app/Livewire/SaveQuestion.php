<?php

namespace App\Livewire;

use App\Models\SavedQuestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SaveQuestion extends Component
{
    public $questionId;
    public $isSaved = false;

    public function mount($questionId)
    {
        $this->questionId = $questionId;
        $this->checkIfSaved();
    }

    public function checkIfSaved()
    {
        $this->isSaved = SavedQuestion::where('user_id', Auth::id())
            ->where('question_id', $this->questionId)
            ->exists();
    }

    public function toggleSave()
    {
        if (!Auth::check()) {
            return session()->flash('message', 'Вы должны быть авторизованы для сохранения вопросов.');
        }

        if ($this->isSaved) {
            SavedQuestion::where('user_id', Auth::id())
                ->where('question_id', $this->questionId)
                ->delete();
            $this->isSaved = false;
        } else {
            SavedQuestion::create([
                'user_id' => Auth::id(),
                'question_id' => $this->questionId
            ]);
            $this->isSaved = true;
        }
    }

    public function render()
    {
        return view('livewire.save-question');
    }
}
