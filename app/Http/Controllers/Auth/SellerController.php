<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SellerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:seller');
    }

    /**
     * Show seller deshboard
     *
     * @return view
     */
    public function index(){
        return view('seller');
    }
}
