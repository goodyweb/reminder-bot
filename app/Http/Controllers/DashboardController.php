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

        // For Statistics
        $tot_fixeddate = count($fixeddate);
        $tot_unfixeddate = count($unfixeddate);
        $tot_users = count(User::all());

        return view('dashboard')
                    ->with('fixeddate', $fixeddate)
                    ->with('unfixeddate', $unfixeddate)
                    ->with('tot_fixeddate', $tot_fixeddate)
                    ->with('tot_unfixeddate', $tot_unfixeddate)
                    ->with('tot_users', $tot_users);
    }
    
}
