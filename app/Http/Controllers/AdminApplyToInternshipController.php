<?php

namespace App\Http\Controllers;

use App\Models\Internship;

class AdminApplyToInternshipController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Internship $internship)
    {
        $company = $internship->load('company');
        return view('admin.internships.apply', compact('internship', 'company'));
    }
}
