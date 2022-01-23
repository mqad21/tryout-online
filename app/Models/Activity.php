<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public const WORKER = 1;
    public const STUDENT = 2;
    public const ENTREPENEUR = 3;
    public const NON_JOB = 4;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
