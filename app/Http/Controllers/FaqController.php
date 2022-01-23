<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('pages.faq.index', compact('faqs'));
    }

    public function index_post(Request $request)
    {
        Faq::truncate();
        if ($request->faq) {
            $faqs = collect($request->faq)->values()->all();
            foreach ($faqs as $faq) {
                Faq::create($faq);
            }
        }
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menyimpan FAQ',
            'title' => 'Berhasil'
        ]);
    }
}