<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Event;
use App\Models\Faq;
use App\Models\News;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade;
use Pharaonic\Laravel\Readable\Readable;

class HomePageController extends Controller
{

    /**
     * Halaman Depan.
     */
    public function index(Request $request)
    {
        $news = News::orderByDesc('date')->take(3)->get();
        $alumni = Readable::getHumanNumber(User::alumni()->count());
        $programs = Program::all();
        return view('homepage.index', compact('news', 'alumni', 'programs'));
    }

    /**
     * Halaman Kumpulan Berita.
     */
    public function berita(Request $request)
    {
        $news = News::orderByDesc('date')
            ->when(isset($request->q), function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('body', 'LIKE', '%' . $request->q . '%');
            })
            ->paginate(3);
        $popular_news = News::popular()->get();
        return view('homepage.berita.index', compact('news', 'popular_news'));
    }
    /**
     * Halaman Detail Berita.
     */
    public function detail_berita(Request $request, $slug)
    {
        $news = News::firstWhere('slug', $slug);
        if (!$news) abort(404);

        $news->view_count++;
        $news->save();

        $share_links = ShareFacade::currentPage('Berita Ikaman 1 Medan: ' . $news->title)
            ->facebook()
            ->twitter()
            ->whatsapp()
            ->getRawLinks();

        $popular_news = News::popular()->get();
        return view('homepage.berita.detail', compact('news', 'popular_news', 'share_links'));
    }

    /**
     * Halaman tentang IKAMAN.
     */
    public function tentang(Request $request)
    {
        $about_pages = AboutPage::all();
        return view('homepage.tentang.index', compact('about_pages'));
    }

    /**
     * Halaman Event.
     */
    public function event()
    {
        $events = Event::orderByDesc('id')->paginate(3);
        return view('homepage.event.index', compact('events'));
    }

    /**
     * Halaman Galeri.
     */
    public function galeri()
    {
        return view('homepage.galeri.index');
    }

    /**
     * Halaman Program Kerja.
     */
    public function program(Request $request, $id)
    {
        $program = Program::with('division')->findOrFail($id);
        $programs = Program::all()->filter(function ($item) use ($id) {
            return $item->id != $id;
        });
        return view('homepage.program.index', compact('program', 'programs'));
    }

    /**
     * Halaman Frequently Asked Questions.
     */
    public function faq()
    {
        $faqs = Faq::all();
        return view('homepage.faq.index', compact('faqs'));
    }

    public function privacy_policy()
    {
        return view('homepage.privacy_policy');
    }

    public function data_deletion()
    {
        return view('homepage.data_deletion');
    }

    public function scanner()
    {
        return view('homepage.scanner');
    }

    public function scannerResult(Request $request, $uuid)
    {
        if ($user = User::firstWhere('uuid', $uuid)) {
            return view('homepage.result', compact('user'));
        }
        return view('homepage.result');
    }
}
