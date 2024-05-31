<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyInternshipApplicationController extends Controller
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
        if ($request->has('accept')) {
            DB::table('internship_applications')
                ->where('id', $id)
                ->update(['status' => Internship::STATUS_ACCEPTED]);

            return redirect()->back()->with('success', 'Your have successfully accepted the internship applicant');
        }

        if ($request->has('reject')) {
            DB::table('internship_applications')
                ->where('id', $id)
                ->update(['status' => Internship::STATUS_REJECTED]);

            return redirect()->back()->with('success', 'Your have successfully rejected the internship applicant');
        }

        if ($request->has('pending')) {
            DB::table('internship_applications')
                ->where('id', $id)
                ->update(['status' => Internship::STATUS_PENDING]);

            return redirect()->back()->with('success', 'Your have successfully reverted the internship applicant request status');
        }

        return redirect()->back()->with('error', 'There was a problem sending this place request');
    }
}
