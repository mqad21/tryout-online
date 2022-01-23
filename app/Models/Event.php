<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function scopeOwn($query)
    {
        $role = Auth::user()->role_id;
        if ($role == Role::KETUA_BIDANG || $role == Role::ANGGOTA_BIDANG) {
            return $query->where('user_id', Auth::user()->id);
        }
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getReadableStartDateAttribute()
    {
        return date("Y-m-d\TH:i:s", strtotime($this->start_date));
    }

    public function getReadableEndDateAttribute()
    {
        return date("Y-m-d\TH:i:s", strtotime($this->end_date));
    }

    public function getFullDateAttribute()
    {
        if ($this->end_date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date)->isoFormat('DD MMM') . ' - '
                . Carbon::createFromFormat('Y-m-d H:i:s', $this->end_date)->isoFormat('DD MMM Y');
        }
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date)->isoFormat('DD MMM, Y');
    }

    public function getFullTimeAttribute()
    {
        if ($this->end_date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date)->isoFormat('HH.mm') . ' - '
                . Carbon::createFromFormat('Y-m-d H:i:s', $this->end_date)->isoFormat('HH.mm') . ' WIB';
        }
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date)->isoFormat('HH II');
    }

    public function getDescriptionSortAttribute()
    {
        return Str::limit(strip_tags($this->description), 50, '...');
    }

    public function getPageAttribute()
    {
        $events = Event::orderByDesc('id')->get();
        $index = $events->search(function ($item) {
            return $item->id == $this->id;
        });
        return intval(ceil(($index + 1) / 3));
    }
}
