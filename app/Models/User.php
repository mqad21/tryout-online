<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class User extends Model implements Authenticatable
{
    use AuthAuthenticatable;

    protected $guarded = [];
    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function getShortNameAttribute()
    {
        $shortName = $this->name;
        $wordCount = Str::of($shortName)->wordCount();
        while (strlen(Str::words($this->name, $wordCount, '')) > 20) {
            $wordCount = $wordCount - 1;
            if ($wordCount > 0) {
                $shortName = Str::words($this->name, $wordCount, '');
            } else {
                break;
            }
        }
        return $shortName;
    }

    public function Tests() {
        return $this->hasMany(Test::class)->whereNotNull('done_at');
    }
}
