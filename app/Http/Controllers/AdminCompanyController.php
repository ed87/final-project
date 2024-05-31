<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class AdminCompanyController extends Controller
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
        $companies = Company::with('internships')->latest()->paginate();
        
        return view('admin/companies/index', compact('companies'));
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
     * @param  \App\Models\Job  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $internships = $company->internships()->latest()->paginate();

        $university = auth()->user()->university()->firstOrFail();

        $university = $university->load([
            'internshipApplications' => function ($query) use ($company) {
                $query->wherePivot('company_id', $company->id);
            }
        ]);
        
        return view('admin/companies/show', compact('company', 'university', 'internships'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin/companies/edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'status' => ['required'],
        ]);

        $company->update([
            'status' => $validatedData['status'],
        ]);
    
        return back()->with('success', 'The Company Status Has Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return back()->with('success', 'The Company Has been Deleted Successfully');
    }
}
