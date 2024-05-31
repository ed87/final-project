<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyAccountController extends Controller
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
        $company = auth()->user()->company()->firstOrFail();
        return view('company/account/show', compact('company'));
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
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:14'],
            'email' => 'required|string|email|max:255|unique:companies,email',
            'description' => ['required', 'string', 'max:3000'],
        ]);

        $company = auth()->user()->company()->create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'description' => $validatedData['description']
        ]);

        return redirect()->route('company.home')->with('success', 'Your company Account Has Been Created Successfully');
    }

    public function update(Request $request, Company $company)
    {
        // name, address, phone, email, description
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:14'],
            'email' => 'required|string|email|max:255|unique:companies,email,' . $company->id,
            'description' => ['required', 'string', 'max:3000'],
        ]);

        $company->update([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'description' => $validatedData['description'],
        ]);

        return back()->with('success', 'The Company Details Have Been Updated Successfully');
    }
}
