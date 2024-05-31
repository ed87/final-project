<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
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
        $university = auth()->user()->university()->firstOrFail();

        return view('admin/account/show', compact('university'));
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
            'email' => 'required|string|email|max:255|unique:universities,email',
            'description' => ['required', 'string', 'max:3000'],
        ]);

        $university = auth()->user()->university()->create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'description' => $validatedData['description']
        ]);

        return redirect()->route('admin.home')->with('success', 'Your University Account Has Been Created Successfully');
    }

    public function update(Request $request, University $university)
    {
        // name, address, phone, email, description
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:14'],
            'email' => 'required|string|email|max:255|unique:universities,email,' . $university->id,
            'description' => ['required', 'string', 'max:3000'],
        ]);

        $university->update([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'description' => $validatedData['description'],
        ]);

        return back()->with('success', 'The University Details Have Been Updated Successfully');
    }
}
