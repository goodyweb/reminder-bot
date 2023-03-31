<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unfixeddate;
use App\Models\Fixeddate;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function index()
    {
        $fixeddate = Fixeddate::orderBy('created_at', 'desc')->paginate(5);
        $unfixeddate = Unfixeddate::orderBy('created_at', 'desc')->paginate(5);

        // For Statistics
        $tot_fixeddate = count(Fixeddate::all());
        $tot_unfixeddate = count(Unfixeddate::all());
        $tot_users = count(User::all());

        return view('dashboard')
                    ->with('fixeddate', $fixeddate)
                    ->with('unfixeddate', $unfixeddate)
                    ->with('tot_fixeddate', $tot_fixeddate)
                    ->with('tot_unfixeddate', $tot_unfixeddate)
                    ->with('tot_users', $tot_users);
    }
    
}
