<?php

namespace App\Http\Controllers;

use App\DataTables\NewsDataTable;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function daftar_berita(NewsDataTable $datatable)
    {
        return $datatable->render('pages.berita.daftar-berita');
    }

    public function buat_berita()
    {
        return view('pages.berita.buat-berita');
    }

    public function buat_berita_post(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:news',
            'date' => 'required',
            'body' => 'required',
            'featured_image_file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->file('featured_image_file')) {
            $photo = $request->file('featured_image_file');
            $filename = uniqid() . "_news." . $photo->getClientOriginalExtension();
            $photo->move("featured_image_news", $filename);
            $request['featured_image'] = asset('featured_image_news/' . $filename);
        }

        if ($request->submit == 'publish') {
            $request['is_draft'] = false;
        } else {
            $request['is_draft'] = true;
        }

        $news = collect($request)->only('title', 'slug', 'date', 'body', 'featured_image', 'is_draft')->toArray();
        News::create($news);

        return redirect('/berita')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil membuat berita',
            'title' => 'Berhasil'
        ]);
    }

    public function edit_berita($id)
    {
        $news = News::withoutGlobalScope('published')->findOrFail($id);
        return view('pages.berita.buat-berita', compact('news'));
    }

    public function edit_berita_post(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'date' => 'required',
            'body' => 'required',
        ]);

        if ($request->file('featured_image_file')) {
            $photo = $request->file('featured_image_file');
            $filename = uniqid() . "_news." . $photo->getClientOriginalExtension();
            $photo->move("featured_image_news", $filename);
            $request['featured_image'] = asset('featured_image_news/' . $filename);
        }

        if ($request->submit == 'publish') {
            $request['is_draft'] = false;
        } else {
            $request['is_draft'] = true;
        }

        $news = collect($request)->only('title', 'slug', 'date', 'body', 'featured_image', 'is_draft')->toArray();
        News::withoutGlobalScopes()->findOrFail($id)->update($news);

        return redirect('/berita')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil mengedit berita',
            'title' => 'Berhasil'
        ]);
    }

    public function hapus_berita(Request $request, $id)
    {
        News::withoutGlobalScope('published')->findOrFail($id)->delete();
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menghapus berita',
            'title' => 'Berhasil'
        ]);
    }
}