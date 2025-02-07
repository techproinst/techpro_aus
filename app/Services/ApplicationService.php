<?php

namespace  App\Services;

use App\Models\PaymentSchedule;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;

class ApplicationService 
{
    public function getLocation()
    {
        $position = Location::get(request()->ip());
    
        if ($position && isset($position->countryCode)) {
            $countryCode = $position->countryCode;
            Log::info("User Country Code Detected: " . $countryCode);
            
            $continents = [
                'AF' => 'Africa', 'DZ' => 'Africa', 'AO' => 'Africa', 'BJ' => 'Africa', 'BW' => 'Africa',
                'BF' => 'Africa', 'BI' => 'Africa', 'CM' => 'Africa', 'CV' => 'Africa', 'CF' => 'Africa',
                'TD' => 'Africa', 'KM' => 'Africa', 'CD' => 'Africa', 'DJ' => 'Africa', 'EG' => 'Africa',
                'GQ' => 'Africa', 'ER' => 'Africa', 'SZ' => 'Africa', 'ET' => 'Africa', 'GA' => 'Africa',
                'GM' => 'Africa', 'GH' => 'Africa', 'GN' => 'Africa', 'GW' => 'Africa', 'CI' => 'Africa',
                'KE' => 'Africa', 'LS' => 'Africa', 'LR' => 'Africa', 'LY' => 'Africa', 'MG' => 'Africa',
                'MW' => 'Africa', 'ML' => 'Africa', 'MR' => 'Africa', 'MU' => 'Africa', 'YT' => 'Africa',
                'MA' => 'Africa', 'MZ' => 'Africa', 'NA' => 'Africa', 'NE' => 'Africa', 'NG' => 'Africa',
                'RW' => 'Africa', 'ST' => 'Africa', 'SN' => 'Africa', 'SC' => 'Africa', 'SL' => 'Africa',
                'SO' => 'Africa', 'ZA' => 'Africa', 'SS' => 'Africa', 'SD' => 'Africa', 'TZ' => 'Africa',
                'TG' => 'Africa', 'TN' => 'Africa', 'UG' => 'Africa', 'EH' => 'Africa', 'ZM' => 'Africa',
                'ZW' => 'Africa',
    
                // Other continents
                'US' => 'North America', 'CA' => 'North America', 'MX' => 'North America',
                'BR' => 'South America', 'AR' => 'South America', 'CL' => 'South America',
                'DE' => 'Europe', 'FR' => 'Europe', 'IT' => 'Europe',
                'CN' => 'Asia', 'JP' => 'Asia', 'IN' => 'Asia',
                'AU' => 'Oceania', 'NZ' => 'Oceania'
            ];
    
            // Check if country code exists in the continents list
            $continent = $continents[$countryCode] ?? 'Other';
    
            Log::info("User Continent Detected: " . $continent);
            return $continent;
        } 
    
        Log::info("User Location Not Found, Defaulting to 'Other'");
        return "Other";
    }
    
     public function getCountry()
     {
        $position = Location::get(request()->ip());

        if ($position) {

            $country = $position->countryName ?? 'N/A';
    
            return  $country;
        } else {

            return 'N/A';
    
        }
     }

     public function coursePrices($courses, $location, $courseIds)
     {
        $basicPackage = null;
        $completePackage = null;
        $jobPackage = null;

        foreach($courses  as $course) {

           if($course->paymentSchedule) {

               $paymentSchedule = json_decode($course->paymentSchedule->amount, true);
               $price = $paymentSchedule[$location] ?? $paymentSchedule['Other'];

               if($course->id === $courseIds['basic'] ) {

                   $basicPackage = [

                       'course_id' => $course->id,
                       'price' => $price,
   
                   ];
   
               }elseif($course->id === $courseIds['complete']) {

                   $completePackage = [
                       'course_id' => $course->id,
                       'price' => $price,
       
                       ];


               }elseif($course->id === $courseIds['job']) {

                   $jobPackage = [
                       'course_id' => $course->id,
                       'price' => $price,
       
                       ];


               }




           }

        }


        return [$basicPackage, $completePackage, $jobPackage];

   
     }

      public function getStudent($id) 
     {
       
        $student = Student::with('courses')->where('id', $id)->first();
         
        if(!$student) {
   
         throw new Exception("Student with ID {$id} not found");
       }
   
       return $student;
   
     }



  


    public function getCourseIds($student)
    {
   
   
       return $student->courses->pluck('id')->toArray();

    }




     
    public function getPaymentSchedule($courseIds) 
    {  
        $schedules = PaymentSchedule::whereIn('course_id', (array) $courseIds)->get();

        if($schedules->isEmpty()) {

        throw new Exception("Payment schedule for course(s) not found");

        }


        return $schedules;

    }

        public function getScheduleAmount($paymentSchedule) 
    {   
        
        $continent = $this->getLocation() ?? 'Other';

         if($continent !== 'Africa') {

            $continent = 'Other';
         }

         $paymentScheduleAmounts = $paymentSchedule->pluck('amount');

         $amountDue = 0;


         foreach($paymentScheduleAmounts as $value) {

            $amounts = json_decode($value, true);

            //dd($amounts);

            Log::info('Available amounts: '. json_encode($amounts));

            $amountDue += $amounts[$continent] ?? $amounts['Other'] ?? 0;

            
        

         }


         if($amountDue === 0) {

            Log::error('No valid amount found for continent ' . $continent . 'Availalble options: '.json_encode($paymentScheduleAmounts));

             throw new Exception('Payment amount for your region' . ($continent). 'not available');


         }

      
      

        

        return [$amountDue, $continent];

    }


   











}