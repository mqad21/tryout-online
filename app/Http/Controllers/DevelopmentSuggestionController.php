<?php

namespace App\Http\Controllers;

use App\DataTables\DevelopmentSuggestionsDataTable;
use App\Models\DevelopmentSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevelopmentSuggestionController extends Controller
{
    
    public function daftar_saran(DevelopmentSuggestionsDataTable $datatable)
    {
        return $datatable->render('pages.saran.saran-website');
    }

    public function simpan_saran(Request $request)
    {
        DevelopmentSuggestion::create([
            'user_id' => Auth::user()->id,
            'suggestion' => $request->suggestion
        ]);

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Saran dan masukan Anda berhasil kami tampung',
            'title' => 'Berhasil'
        ]); 
    }

}
