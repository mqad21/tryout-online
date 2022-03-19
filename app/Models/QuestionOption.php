<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $guarded = [];

    public function Question() {
        return $this->belongsTo(Question::class);
    }

    public function Answers() {
        return $this->hasMany(TestAnswer::class);
    }

}
