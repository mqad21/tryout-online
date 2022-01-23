<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{

    public function index()
    {
        $pages = AboutPage::all();
        return view('pages.halaman.tentang.index', compact('pages'));
    }

    public function index_post(Request $request)
    {
        AboutPage::truncate();
        if ($request->page) {
            $pages = collect($request->page)->values()->all();
            foreach ($pages as $page) {
                AboutPage::create($page);
            }
        }
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menyimpan halaman tentang',
            'title' => 'Berhasil'
        ]);
    }
}
