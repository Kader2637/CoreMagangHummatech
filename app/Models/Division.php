<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Mentor()
    {
        return $this->hasMany(Mentor::class);
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function mentordivision()
    {
        return $this->hasMany(MentorDivision::class);
    }


}
