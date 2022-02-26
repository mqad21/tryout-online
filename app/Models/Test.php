<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Test extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['duration', 'answers_list'];

    public function scopeOwn()
    {
        return $this->where('user_id', Auth::user()->id)->whereNotNull('done_at');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($test) {
            $test->user_id = Auth::user()->id;
        });
    }

    public function done()
    {
        return $this->update(['done_at' => Carbon::now()]);
    }

    public function TryOut()
    {
        return $this->belongsTo(TryOut::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Answers()
    {
        return $this->hasMany(TestAnswer::class);
    }

    public function getIsOnProgressAttribute()
    {
        $now = Carbon::now();
        return $now->isBetween($this->startedAt, $this->expiredAt);
    }

    public function getRemainingTimeAttribute()
    {
        $now = Carbon::now();
        return $now->diffInMilliSeconds($this->expiredAt, false);
    }

    public function getExpiredAtAttribute()
    {
        return $this->startedAt->copy()->addMinutes($this->tryOut->duration);
    }

    public function getStartedAtAttribute()
    {
        return Carbon::parse($this->created_at);
    }

    public function getDurationAttribute()
    {
        return $this->started_at->diff(Carbon::parse($this->done_at))->format('%H:%I:%S');;
    }

    public function getAnswersListAttribute()
    {
        if (!$this->done_at) return null;
        return $this->answers()->get()->pluck('question_option_id', 'question_id');
    }

    public function getScoreAttribute()
    {
        return $this->answers()->with(['option.question.category'])->get()->unique('option.question_id')->groupBy('option.question.category.name')->map->sum('option.score');
    }

    public function getScoreSumAttribute()
    {
        return $this->answers()->with(['option.question.category'])->get()->unique('option.question_id')->sum('option.score');
    }
}
