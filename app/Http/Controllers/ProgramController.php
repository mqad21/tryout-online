<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{

    public function index()
    {
        $programs = Program::own()->with(['division','user'])->get();
        return view('pages.proker.index', compact('programs'));
    }

    public function index_post(Request $request)
    {
        if ($request->program) {
             foreach ($request->program as $key => $program) {
                Program::find($key)->update([
                    'program' => $program,
                    'user_id' => Auth::user()->id
                ]);
            }
        }
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menyimpan program kerja',
            'title' => 'Berhasil'
        ]);
    }
}