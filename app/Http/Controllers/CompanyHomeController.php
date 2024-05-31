<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
// use Illuminate\Http\Request;

class CompanyHomeController extends Controller
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
        // dd(auth()->user()->company()->count());
        if(auth()->user()->company()->count() < 1){
            return view('company/create');
        }
        
        return view('company/home');
    }
}
