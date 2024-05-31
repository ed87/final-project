<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;

class CompanyInternshipController extends Controller
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
        $company = auth()->user()->company()->firstOrFail();
        $internships = $company->internships()->with('universityApplicants')->latest()->paginate(10);
        
        return view('company/internships/index', compact('company', 'internships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company/internships/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string', 'max:3000'],
        ]);

        $company = auth()->user()->company()->firstOrFail();

        $company->internships()->create([
            'company_id' => $company->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);
    
        return redirect()->route('company.internship.index')->with('success', 'New Internship Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function show(Internship $internship)
    {
        $internship = $internship->load('universityApplicants');
        
        return view('company/internships/show', compact('internship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function edit(Internship $internship)
    {
        return view('company/internships/edit', compact('internship'));
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
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string', 'max:3000'],
        ]);

        $internship->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);
    
        return back()->with('success', 'The Internship Details Have Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Internship $internship)
    {
        $internship->delete();
        return redirect()->route('company.internship.index')->with('success', 'Internship Deleted Successfully');
    }
}
