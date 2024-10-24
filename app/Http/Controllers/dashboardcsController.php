<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardcsController extends Controller
{
    public function index()
    {
        return view('Dashboard.dashboardcs');
    }
}
