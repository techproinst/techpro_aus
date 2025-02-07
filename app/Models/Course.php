<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function paymentSchedule()
    {
        return $this->hasOne(PaymentSchedule::class, 'course_id', 'id');
    }

    public function student()
    {
        return $this->belongsToMany(Student::class, 'students_courses', 'courses_id', 'students_id');
    }
}
