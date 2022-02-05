<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function option() {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }

}
