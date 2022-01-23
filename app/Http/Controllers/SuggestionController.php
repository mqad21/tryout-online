<?php

namespace App\Http\Controllers;

use App\DataTables\SuggestionsDataTable;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    
    public function daftar_saran(SuggestionsDataTable $datatable)
    {
        return $datatable->render('pages.saran.saran-ikaman');
    }

    public function simpan_saran(Request $request)
    {
        $suggestion = $request->only('name', 'email', 'phone', 'type', 'message');
        Suggestion::create($suggestion);
        return redirect()->back()->with('alert', true);
    }

}
