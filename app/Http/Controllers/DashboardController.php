<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{

    // Halaman dasbor.
    public function index()
    {
        $greet = $this->get_greeting();
        return view('pages.dashboard', compact('greet'));
    }

    private function get_greeting()
    {
        date_default_timezone_set('Asia/Jakarta');
        $hour = date('G');
        if ($hour >= 5 && $hour <= 11) {
            return "Selamat Pagi";
        } else if ($hour >= 12 && $hour <= 18) {
            return "Selamat Siang";
        } else if ($hour >= 19 || $hour <= 4) {
            return "Selamat Malam";
        }
    }
}
