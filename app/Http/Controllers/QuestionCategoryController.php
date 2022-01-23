<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionCategoryDataTable;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionCategoryDataTable $datatable)
    {
        return $datatable->render('pages.question-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.question-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        QuestionCategory::create($request->only('name'));
        return redirect()->route('question-category.index')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil Menambahkan Kategori Soal',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionCategory $questionCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionCategory $questionCategory)
    {
        return view('pages.question-category.create', compact('questionCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionCategory $questionCategory)
    {
        $questionCategory->update($request->only('name'));
        return redirect()->route('question-category.index')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil Memperbarui Kategori Soal',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionCategory $questionCategory)
    {
        $questionCategory->delete();
    }
}
