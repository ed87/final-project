<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantJobApplicationController extends Controller
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
        // A list of all jobs the user applied to 
        $job_applications = auth()->user()->jobApplications()->paginate();

        return view('applicant/job-applications/index', compact('job_applications'));
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
            'cv_file' => 'required|file|mimes:csv,txt,pdf|max:2048'
        ]);

        $cv_file = $request->file('cv_file');
        $user_name = str_replace(' ', '_', auth()->user()->username);
        $cv_file_name = $user_name . '_'. auth()->id() . '_'. time() . '.' . $request->file('cv_file')->getClientOriginalName();

        $cv_file_path = public_path('/uploads/cv_files');
        
        $cv_file->move($cv_file_path, $cv_file_name);

        $job = Job::where('id', $request->job_id)->firstOrFail();

        auth()->user()->jobApplications()->attach($job->id, [
            'company_id' => $job->company_id,
            'cv_file' => $cv_file_name
        ]);

        
        return redirect()->route('applicant.job.show', $job->id)->with('success', 'You Applied To The Job Successfully');
        // return back()->with('success', 'You have successfully applied to the job');
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
        //
    }

    public function destroy($id)
    {
        $job_application = auth()->user()->jobApplications()->where('job_id', $id)->firstOrFail();

        DB::table('job_applications')
                ->where('id', $job_application->pivot->id)
                ->delete();

        return redirect()->route('applicant.job.show', $id)->with('success', 'Job Application Deleted Successfully');
    }
}
