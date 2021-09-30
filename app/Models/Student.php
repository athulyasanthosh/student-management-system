<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function countryName()
    {
        return $this->belongsTo(Country::class, 'country','id');
    }
    public function stateName()
    {
        return $this->belongsTo(State::class, 'state','id');
    }
    public function studentMarks()
    {
        return $this->hasMany(Mark::class);
    }
    
}
