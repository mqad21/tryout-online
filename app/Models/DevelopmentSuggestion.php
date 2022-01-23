<?php

namespace App\Models;

use App\DataTables\DevelopmentSuggestionsDataTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentSuggestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function daftar_saran(DevelopmentSuggestionsDataTable $datatable)
    {
        return $datatable->render('pages.berita.daftar-berita');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
