<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;

// use App\Models\Job;
// use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $companies_count = Company::count();
        $university = auth()->user()->university()->firstOrFail();
        $internship_applications_count = $university->internshipApplications()->count();

        return view('admin/home', compact('companies_count', 'internship_applications_count'));
    }
}
