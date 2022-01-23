<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Program extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeOwn($query)
    {
        $role = Auth::user()->role_id;
        if ($role == Role::KETUA_BIDANG || $role == Role::ANGGOTA_BIDANG) {
            return $query->where('division_id', Auth::user()->division_id);
        }
        return $query;
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
