<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryOut extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeVisible($query)
    {
        return $query->where('show_try_out', 1)->whereDate('start_date', '<=', Carbon::now())->whereDate('end_date', '>=', Carbon::now());
    }

    public function Questions()
    {
        return $this->belongsToMany(Question::class)->orderBy('question_try_out.id')->withTimestamps();
    }

    public function Tests()
    {
        return $this->hasMany(Test::class);
    }

    public function getRangeAttribute()
    {
        return Carbon::parse($this->start_date)->format("d/m/Y") . ' - ' . Carbon::parse($this->end_date)->format("d/m/Y");
    }

    public function getCategoriesAttribute()
    {
        return $this->questions->map->category->unique();
    }

    public function getRankAttribute()
    {
        return $this->tests()->with(['user', 'user.region'])->whereNotNull('done_at')->get()->append(['score'])->sortByDesc('score_sum')->groupBy('user_id')->values()->map(function ($item, $index) {
            $firstItem = $item->first();
            $firstItem->rank = $index + 1;
            $firstItem->score_sum = $index + 1;
            return $firstItem;
        })->sortByDesc('score_sum');
    }
}
