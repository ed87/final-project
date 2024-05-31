<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyJobApplicationController extends Controller
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
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($job->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        // dd('hit update job application');


        if ($request->has('accept')) {
            DB::table('job_applications')
                ->where('id', $id)
                ->update(['status' => Job::STATUS_ACCEPTED]);

            return redirect()->back()->with('success', 'Your have successfully accepted the job applicant');
        }

        if ($request->has('reject')) {
            DB::table('job_applications')
                ->where('id', $id)
                ->update(['status' => Job::STATUS_REJECTED]);

            return redirect()->back()->with('success', 'Your have successfully rejected the job applicant');
        }

        if ($request->has('pending')) {
            DB::table('job_applications')
                ->where('id', $id)
                ->update(['status' => Job::STATUS_PENDING]);

            return redirect()->back()->with('success', 'Your have successfully reverted the job applicant request status');
        }

        return redirect()->back()->with('error', 'There was a problem sending this place request');
    }
}
