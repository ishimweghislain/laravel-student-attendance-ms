<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration',
         'class'
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'courseid');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'courseid');
    }
}
