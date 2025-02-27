<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    const Pending = 0;
    const Active = 1;
    const Declined = -1;


    static public function trxRef()
    {
        // Generate a random 4-digit number
        $part1 = rand(1000, 9999);
    
        // Generate a random alphanumeric string (4 characters, uppercase)
        $part2 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4));
    
        // Generate another random 4-digit number
        $part3 = rand(1000, 9999);
    
        // Generate a random alphanumeric string (3 characters, uppercase)
        $part4 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 3));
    
        // Combine all parts
        return 'TXN-' . $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4;

    }

    static public function inv()
    {
        // Generate a random 4-digit number
        $part1 = rand(1000, 9999);
    
        // Generate a random alphanumeric string (4 characters, uppercase)
        $part2 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4));
    
        // Generate another random 4-digit number
        $part3 = rand(1000, 9999);
    
        // Generate a random alphanumeric string (3 characters, uppercase)
        $part4 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 3));
    
        // Combine all parts
        return 'INV-' . $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4;
        
    }


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id')->withTrashed();
    }

    
    public function paymentSchedules() {

        return $this->belongsToMany(PaymentSchedule::class, 'payment_payment_schedule',   'payment_id', 'payment_schedule_id');
    }
    



}
