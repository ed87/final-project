<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminInternshipApplicationController extends Controller
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
        // Get the university belonging to the user
        $university = auth()->user()->university()->firstOrFail();

        // let the university apply for the internship
        $internship_applications = $university->internshipApplications()->latest()->paginate();

        return view('admin/internship-applications/index', compact('internship_applications'));
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
            'internship_letter' => 'required|file|mimes:csv,txt,pdf|max:2048'
        ]);

        $internship_letter = $request->file('internship_letter');
        $internship_letter_name = auth()->id() . '_'. time() . '.' . $request->file('internship_letter')->getClientOriginalName();

        $internship_letter_path = public_path('/uploads/internship_letters');
        
        // $cv_file->move($cv_file_path, $cv_file_name);
        $internship_letter->move($internship_letter_path, $internship_letter_name);

        $internship = Internship::where('id', $request->internship_id)->firstOrFail();
        $internship_company = $internship->load('company');

        $university = auth()->user()->university()->firstOrFail();

        $university->internshipApplications()->attach($internship->id, [
            'company_id' => $internship->company_id,
            'internship_letter' => $internship_letter_name
        ]);

        return redirect()->route('admin.company.show', $internship_company->company_id)->with('success', 'The University Applied To the Internship Successfully');
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
        $university = auth()->user()->university()->firstOrFail();

        $internship_application = $university->internshipApplications()->where('internship_id', $id)->firstOrFail();

        DB::table('internship_applications')
                ->where('id', $internship_application->pivot->id)
                ->delete();

        return redirect()->route('admin.internship.show', $id)->with('success', 'Internship Application Deleted Successfully');
    }
}
