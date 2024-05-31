<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyUserAccountController extends Controller
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
        $user = auth()->user();
        return view('company/user-account/show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,'. $user->id,
        ]);

        $user->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
        ]);
    
        return back()->with('success', 'The User Account Details Have Been Updated Successfully');
    }
}
