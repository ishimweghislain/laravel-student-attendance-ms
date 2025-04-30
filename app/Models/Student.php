<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    

    protected $primaryKey = 'studentid';

    protected $fillable = [
        'fname',
        'lname',
        'gender',
        'dateofb',
        'contactnumber',
        'email',
        'address',
        'enrollmentdate',
        'class' 
    ];

    protected $dates = [
        'dateofb',
        'enrollmentdate'
    ];
}