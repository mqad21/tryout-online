<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryOut extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Questions()
    {
        return $this->belongsToMany(Question::class)->orderBy('question_try_out.id')->withTimestamps();
    }

    public function getRangeAttribute()
    {
        return Carbon::parse($this->start_date)->format("d/m/Y") . ' - ' . Carbon::parse($this->end_date)->format("d/m/Y");
    }

    public function Tests() {
        return $this->hasMany(Test::class);
    }
}
