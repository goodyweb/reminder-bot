<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UnfixedDate;
use App\Models\Fixeddate;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function index()
    {
        $fixeddate = Fixeddate::all();
        $unfixeddate = Unfixeddate::all();
        return view('dashboard', compact('fixeddate', 'unfixeddate'));
    }
}
