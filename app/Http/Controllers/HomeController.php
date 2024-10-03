<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminHome(){
        return view('layouts.admin.home');
    }

    public function officerHome(){
        return view('layouts.officer.home');
    }

    public function userHome(){
        return view('layouts.user.home');
    }
}
