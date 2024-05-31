<?php 

namespace App\Http\Responses;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $user_type = Auth::user()->user_type;

        if($user_type == User::TYPE_ADMIN){
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN);
        }

        if($user_type == User::TYPE_APPLICANT){
            return redirect()->intended(RouteServiceProvider::HOME_APPLICANT);
        }

        if($user_type == User::TYPE_COMPANY){
            return redirect()->intended(RouteServiceProvider::HOME_COMPANY);
        }
    }
}