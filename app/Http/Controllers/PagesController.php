<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        $user = User::find(auth()->user());

        return view('welcome')
                ->with('user', $user);
    }

}
