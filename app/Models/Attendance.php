<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    
    protected $fillable = [
        'studentid',
        'courseid',
        'attendance_date',
        'attendance_status'
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