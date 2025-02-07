<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showBusinessAnalysis(ApplicationService $applicationService) 
    {   
         $location = $applicationService->getLocation();

         $businessAnalysisCourses = Course::with('paymentSchedule')->where('course_type', 0)->get();

         $courseIds = [ 'basic' => 1, 'complete' => 2, 'job' => 3];

         list($basicPackage,$completePackage,$jobPackage) = $applicationService->coursePrices($businessAnalysisCourses, $location, $courseIds);

       //  dd($basicPackage);

         return view('pages.business_analysis_course', compact('businessAnalysisCourses','basicPackage','completePackage', 'jobPackage', 'location'));
    }

    public function showScrumMaster(ApplicationService $applicationService)
    {
        $location = $applicationService->getLocation();

        $businessAnalysisCourses = Course::with('paymentSchedule')->where('course_type', 1)->get();

        $courseIds = [ 'basic' => 4, 'complete' => 5, 'job' => 6];

        list($basicPackage,$completePackage,$jobPackage) = $applicationService->coursePrices($businessAnalysisCourses, $location, $courseIds);

        return view('pages.scrum_master_course', compact('businessAnalysisCourses','basicPackage','completePackage', 'jobPackage', 'location'));

    }


    public function getApplicationForm(Course $course)
    {
          return view('application.form', compact('course'));
    }

    public function loadNewCourse(Course  $course)
    {
        return view('application.new_course', compact('course'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
