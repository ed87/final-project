<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Job;
use App\Models\University;
use Illuminate\Http\Request;

class AdminInternshipController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function show(Internship $internship)
    {
        $internship = $internship->latest()->load('company');
        $university = auth()->user()->university()->firstOrFail();

        $has_applied = $university->internshipApplications()->where('internship_id', $internship->id)->count() ? true: false;

        return view('admin/internships/show', compact('internship', 'has_applied'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function edit(Internship $internship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Internship $internship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Internship $internship)
    {
        //
    }

    public function downloadInternshipLetter(University $university, $file_name)
    {
        // dd('hit');
        // dd($file_name);
        // dd($user->toArray());

        $file_path = public_path('uploads/internship_letters/' . $file_name);
        // dd($file_path);
        return response()->download($file_path);
    }
}
