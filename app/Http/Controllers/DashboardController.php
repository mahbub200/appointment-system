<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
        if (Auth::user()->role->name == 'patient') {
            return view('home');
        };

        // dd(Auth::user()->role->name);
        return view('dashboard');
    }
}
