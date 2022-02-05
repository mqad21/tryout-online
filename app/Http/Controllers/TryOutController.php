<?php

namespace App\Http\Controllers;

use App\DataTables\ExplanationDataTable;
use App\DataTables\ResultDataTable;
use App\DataTables\TryOutDataTable;
use App\Models\Question;
use App\Models\Region;
use App\Models\Test;
use App\Models\TryOut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;

class TryOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TryOutDataTable $datatable)
    {
        return $datatable->render("pages.tryout.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.tryout.create");
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
            'name' => 'required',
            'duration' => 'required|numeric',
            'range' => 'required',
            'price' => 'required',
        ]);

        $range = Str::of($request->range)->split('/[\s-]+/');
        $request['start_date'] = Carbon::createFromFormat("d/m/Y", $range[0]);
        $request['end_date'] = Carbon::createFromFormat("d/m/Y", $range[1]);

        $tryout = TryOut::create($request->only('name', 'duration', 'start_date', 'end_date', 'price'));
        return redirect()->route('tryout.set-question', $tryout->id)->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil Menambahkan Try Out',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Set tryout questions.
     */
    public function setQuestions(Request $request, $id)
    {
        $tryout = TryOut::find($id);
        if ($request->questions) {
            $tryout->questions()->detach($request->questions);
            $tryout->questions()->attach($request->questions);
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Berhasil Mengatur Soal Try Out',
                'title' => 'Berhasil'
            ]);
        }

        return view("pages.tryout.set-question", compact('tryout'));
    }

    /**
     * Do try out.
     */
    public function do(Request $request, $id = null)
    {
        if ($id) {
            $id = decrypt($id);
            $tryout = TryOut::findOrFail($id);

            $test = $tryout->tests->whereNull('done_at')->last();
            if (!$test) {
                $test = $tryout->tests()->create();
            }

            return view('pages.tryout.do', compact('test'));
        }

        $tryouts = TryOut::all();
        return view('pages.tryout.list', compact('tryouts'));
    }

    /**
     * Get question view.
     */
    public function getQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $next = $request->next;
        $prev = $request->prev;
        $test = Test::findOrFail($request->testId);
        return view('pages.tryout.question', compact('question', 'next', 'prev', 'test'));
    }

    /**
     * Show explanation.
     */
    public function explanation(ExplanationDataTable $dataTable, Request $request, $id = null)
    {
        if (!$id) {
            $testIsEmpty = Auth::user()->tests->isEmpty();
            return $dataTable->render('pages.tryout.list-done', compact('testIsEmpty'));
        }
        $id = decrypt($id);
        $test = Test::findOrFail($id);
        return view('pages.tryout.do', compact('test'));
    }

    /**
     * Show result json.
     */
    public function result($id)
    {
        $id = decrypt($id);
        $tryout = TryOut::findOrFail($id);
        return view('pages.tryout.result', compact('tryout'));
    }

    /**
     * Show result json.
     */
    public function resultJson(DataTablesDataTables $dataTable, $id)
    {
        $id = decrypt($id);
        $tryout = TryOut::findOrFail($id);
        return $dataTable->collection($tryout->rank)->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TryOut  $tryOut
     * @return \Illuminate\Http\Response
     */
    public function show(TryOut $tryOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TryOut  $tryOut
     * @return \Illuminate\Http\Response
     */
    public function edit(TryOut $tryout)
    {
        return view('pages.tryout.create', compact('tryout'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TryOut  $tryOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TryOut $tryout)
    {
        $tryout->update($request->only('name', 'duration', 'start_date', 'end_date', 'price'));

        return redirect()->route('tryout.index')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil Memperbarui Try Out',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TryOut  $tryOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(TryOut $tryout)
    {
        $tryout->delete();
    }
}
