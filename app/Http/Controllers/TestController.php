<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\SavedQuestion;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $categories = $this->getTestCategoriesWithRelations();

        $savedQuestions = [];
        $mistakes = [];
        $testResults = [];

        if ($user) {
            $savedQuestions = $this->getUserSavedQuestions();

            $mistakes = \App\Models\Mistake::with(['question.answers', 'question'])
                ->where('user_id', $user->id)
                ->get();

            $testResults = \App\Models\TestResult::with('test')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('test.index', compact(
            'categories',
            'savedQuestions',
            'mistakes',
            'testResults'
        ));
    }




    protected function getTestCategoriesWithRelations()
    {
        return Category::query()
            ->where(function ($query) {
                $query->where('category_type', 'test')
                    ->orWhereNull('category_type');
            })
            ->with([
                'children.tests',
                'tests'
            ])
            ->orderByDesc('published_at')
            ->get();
    }

    protected function getUserSavedQuestions()
    {
        return SavedQuestion::query()
            ->where('user_id', auth()->id())
            ->with('question.answers')
            ->get();
    }



    public function show($testId)
    {
        $test = Test::with('questions.answers')->findOrFail($testId);
        $questions = $test->questions()->paginate(1);
        $question = $questions->first();

        return view('test.show', compact('test', 'questions', 'question'));
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

//    public function savedQuestions()
//    {
//        $savedQuestions = SavedQuestion::where('user_id', auth()->id())
//            ->with('question.answers')
//            ->get()
//            ->pluck('question');
//
//        return view('test.saved', compact('savedQuestions'));
//    }


//    public function savedTestResult()
//    {
//        return view('test.saved-result');
//    }







}
