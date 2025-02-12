<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $primaryKey = 'gradeid';
    
    protected $fillable = [
        'studentid',
        'courseid',
        'exam_date',
        'grade'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseid');
    }
}