<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionsDataTable;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionsDataTable $datatable)
    {
        return $datatable->render('pages.question.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questionCategories = QuestionCategory::all();
        return view('pages.question.create', compact('questionCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = Question::create($request->only('question', 'question_category_id', 'explanation'));
        $options = collect($request->options)->map(function ($item) use ($question) {
            $item['question_id'] = $question->id;
            return $item;
        })->all();
        QuestionOption::insert($options);

        return redirect()->route('question.index')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil Menambahkan Soal',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $questionCategories = QuestionCategory::all();
        $questionOptions = $question->options->map(function($option){
            $option->value = $option->option;
            return $option;
        });
        return view('pages.question.create', compact('questionCategories', 'question', 'questionOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update($request->only('question', 'question_category_id', 'explanation'));
        $options = collect($request->options)->map(function ($item) use ($question) {
            $item['question_id'] = $question->id;
            return $item;
        })->all();
        $question->options()->delete();
        QuestionOption::insert($options);

        return redirect()->route('question.index')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil Memperbarui Soal',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
    }
}
