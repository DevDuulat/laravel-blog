<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $categories = Category::where(function ($query) {
            $query->where('category_type', 'test')
                ->orWhereNull('category_type');
        })
            ->with(['children.tests', 'tests'])
            ->latest('published_at')
            ->get();


        return view('test.index', compact('categories'));
    }

    public function show($testId)
    {
        $test = Test::with('questions.answers')->findOrFail($testId);
        $questions = $test->questions()->paginate(1);

        return view('test.show', compact('test', 'questions'));
    }

    public function submit(Request $request, Question $question)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'exists:answers,id',
        ]);

        $correctAnswers = $question->answers()->where('is_correct', true)->pluck('id')->toArray();
        $userAnswers = $request->input('answers');

        $isCorrect = empty(array_diff($correctAnswers, $userAnswers)) && empty(array_diff($userAnswers, $correctAnswers));

        return response()->json(['correct' => $isCorrect]);
    }

    public function result($testId)
    {
        $test = Test::findOrFail($testId);
        $questions = $test->questions;

        $userAnswers = session('test_answers', []);

        $correctAnswers = 0;
        foreach ($questions as $question) {
            if (isset($userAnswers[$question->id]) && $userAnswers[$question->id]['correct']) {
                $correctAnswers++;
            }
        }

        $totalQuestions = $questions->count();

        return view('test.result', compact('test', 'correctAnswers', 'totalQuestions'));
    }




    public function retry($testId)
    {
        $test = Test::findOrFail($testId);

        return redirect()->route('test.show', ['testId' => $test->id]);
    }







}
