<?php

namespace App\Http\Controllers;

use App\Models\FixedDate;
use App\Models\UnfixedDate;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function fixDate(){
        $fixeddates = FixedDate::All();
        foreach($fixeddates as $fixeddate)
        {
            if($fixeddate->frequency == "Annually")
            {

            }elseif($fixeddate->frequency == "Quarterly")
            {

            }elseif($fixeddate->frequency == "Monthly")
            {
                
            }
        }
    }
}
