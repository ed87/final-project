<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class CompanyJobController extends Controller
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
// dd($company->id);
        $jobs = $company->jobs()->with('applicants')->latest()->paginate(10);

        return view('company/jobs/index', compact('company', 'jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company/jobs/create');
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

        $company->jobs()->create([
            'company_id' => $company->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);
    
        return redirect()->route('company.job.index')->with('success', 'New Job Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $job = $job->load('applicants');
// dd($job->toArray());
        return view('company/jobs/show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('company/jobs/edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string', 'max:3000'],
        ]);

        $job->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);
    
        return back()->with('success', 'The Job Details Have Been Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('company.job.index')->with('success', 'Job Deleted Successfully');
    }
}
