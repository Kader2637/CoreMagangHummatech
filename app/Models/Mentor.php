<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class , 'division_id');
    }

    public function mentorstudent()
    {
        return $this->hasMany(MentorStudent::class);
    }

    public function mentordivision()
    {
        return $this->hasMany(MentorDivision::class);
    }

    public function challenge()
    {
        return $this->hasMany(Challenge::class);
    }
}
