<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'question_category_id', 'id');
    }

    public function getCorrectAnswerAttribute() {
        return $this->options()->orderByDesc('score')->first();
    }
}
