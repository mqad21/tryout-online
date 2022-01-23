<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Pharaonic\Laravel\Readable\Readable;

class News extends Model
{
    protected $guarded = [];
    protected $table = 'news';

    protected static function booted()
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('is_draft', false);
        });
    }

    public function scopePopular($query)
    {
        return $query->orderByDesc('view_count')->take(3);
    }

    public function getTruncatedBodyAttribute()
    {
        return Str::limit(strip_tags($this->body), 150, '...');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->date)->isoFormat('DD MMM, Y');
    }

    public function getUrlAttribute()
    {
        return url('berita') . '/' . $this->slug;
    }

    public function getViewCountAttribute($value)
    {
        return Readable::getHumanNumber($value);
    }
}
