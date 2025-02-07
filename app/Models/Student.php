<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];

      
    const  STATUS_PENDING = 0;
    const  STATUS_APPROVED = 1;
    const  STATUS_DECLINED = -1;



    static public function genAppNo($year){

      $uniq = substr(hexdec(uniqid()), -4);
      $num =   strval(rand(1000, 9999));   
      $str =  str_shuffle($num . $uniq);
  

    return   'APP/' . $year . '/' . $str;

  }

/*
    public function course()
    {
      return $this->belongsTo(Course::class, 'course_id', 'id');

    }

    */


    public function  courses() 
    {
      return $this->belongsToMany(Course::class,  'students_courses', 'students_id', 'courses_id');
    }

}
