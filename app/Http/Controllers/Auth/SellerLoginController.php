<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SellerLoginController extends Controller
{

	public function __construct(){
		$this->middleware('guest:seller')->except('logout');
	}

    public function showLoginForm(){
    	return view('auth.seller-login');
    }

    public function login(Request $request){
    	// Validate the form data
    	$this->validate($request, [
    		'email'   => 'required|email',
    		'password' => 'required|min:6'
    	]);

   //  	var_dump(Auth::guard('seller')->attempt([
			// 	'email' => $request->email,
			// 	'password' => $request->password
			// ], $request->remember));
   //  	die;

		// Attempt to log the user in
		if (Auth::guard('seller')->attempt([
				'email' => $request->email,
				'password' => $request->password
			], $request->remember)) {
			// if successful, then redirect to their intended location
			return redirect()->intended(route('seller'));
		}

		// if unsuccessful, then redirect back to the login with the form data
		return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login');
    }
}
