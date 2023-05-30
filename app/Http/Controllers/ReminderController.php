<?php

namespace App\Http\Controllers;

use App\Models\Fixeddate;
use App\Models\Unfixeddate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ReminderController extends Controller
{

    public function fixDateNotifyAnnually(){
        $yearNow = Carbon::now()->year;
        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;

        $fixeddates = FixedDate::where('year', '<=', $yearNow)
        ->where('startMonth', '<=', $monthNow)
        ->where('endMonth', '>=', $monthNow)
        ->where('startDay', '<=', $dayNow)
        ->where('frequency', 'like', 'Annually')
        ->get();

        foreach($fixeddates as $fixeddate){

            if($fixeddate->endMonth >= $monthNow ){

                if($fixeddate->endMonth == $monthNow  && $fixeddate->year == Carbon::now()->year){
                   $days_remaining = $fixeddate->endDay - $dayNow;
                }else{
                    if($fixeddate->endMonth == 1 || $fixeddate->endMonth == 3 || $fixeddate->endMonth == 5 || $fixeddate->endMonth == 7 || $fixeddate->endMonth == 8 || $fixeddate->endMonth == 9 || $fixeddate->endMonth == 10 || $fixeddate->endMonth == 12){                        
                    
                    $days_remaining = ($fixeddate->endDay + 31) - $dayNow;
                    }elseif($fixeddate->endMonth == 4 || $fixeddate->endMonth == 6 || $fixeddate->endMonth == 9 || $fixeddate->endMonth == 11){
                        $days_remaining = ($fixeddate->endDay + 30) - $dayNow;
                    }else{
                        if(date('L', strtotime(Carbon::now())) == 0){
                                $days_remaining = ($fixeddate->endDay + 28) - $dayNow;
                        }else {
                            $days_remaining = ($fixeddate->endDay + 29) - $dayNow;
                        }
                    }
                }
                     if($fixeddate->endDay == Carbon::now()->day && $fixeddate->endMonth == Carbon::now()->month){
                        $addstartmonth = $fixeddate->startMonth;
                        $addendmonth = $fixeddate->endMonth;
                        $fixeddate->startMonth = $addstartmonth;
                        $fixeddate->endMonth = $addendmonth;
                        $fixeddate->year = Carbon::now()->year + 1;
                        $fixeddate->save();

                        Http::post($fixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $fixeddate->user->name . "**, Greetings from GoodyMinder*:scream:!",
                            'embeds' => [                        [
                                    'title' => $fixeddate->details,
                                    'description' => "This is your Annually Due Date of " .$fixeddate->details. "** \n**Due:** " .$fixeddate->getendmonth() . " " .$fixeddate->endDay . ", " .$fixeddate->year,
                                    'color' => '63294',
                                ]
                            ],
                        ]);
                     }elseif($fixeddate->endDay > Carbon::now()->day && $fixeddate->endMonth == Carbon::now()->month && $fixeddate->year == Carbon::now()->year){
                        Http::post($fixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $fixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "**" . $days_remaining . "** day(s) left. \n **Due:** " . $fixeddate->getendmonth() . " " . $fixeddate->endDay . ", " . $fixeddate->year,
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                     }
            }
        }
    }
    public function fixDateNotifySemiAnnually(){

        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;

        $fixeddates = FixedDate::where('startMonth', '<=', $monthNow)
        ->where('endMonth', '>=', $monthNow)
        ->where('startDay', '<=', $dayNow)
        ->where('frequency', 'like', 'SemiAnnually')
        ->get();

        foreach($fixeddates as $fixeddate){

            if($fixeddate->endMonth >= $monthNow ){

                if($fixeddate->endMonth == $monthNow){
                    $days_remaining = $fixeddate->endDay - $dayNow;
                }else{
                    if($fixeddate->endMonth == 1 || $fixeddate->endMonth == 3 || $fixeddate->endMonth == 5 || $fixeddate->endMonth == 7 || $fixeddate->endMonth == 8 || $fixeddate->endMonth == 9 || $fixeddate->endMonth == 10 || $fixeddate->endMonth == 12){                                  
                    $days_remaining = ($fixeddate->endDay + 31) - $dayNow;
                    }elseif($fixeddate->endMonth == 4 || $fixeddate->endMonth == 6 || $fixeddate->endMonth == 9 || $fixeddate->endMonth == 11){
                        $days_remaining = ($fixeddate->endDay + 30) - $dayNow;
                    }else{
                        if(date('L', strtotime(Carbon::now())) == 0){
                            $days_remaining = ($fixeddate->endDay + 28) - $dayNow;
                        }else {
                            $days_remaining = ($fixeddate->endDay + 29) - $dayNow;
                        }
                    }
                }
                     if($fixeddate->endDay == Carbon::now()->day){

                        if($fixeddate->startMonth <= 6 && $fixeddate->endMonth <= 6)
                        {
                            $addstartmonth = $fixeddate->startMonth + 6;
                             $addendmonth = $fixeddate->endMonth + 6;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year;
                        }elseif($fixeddate->startMonth >= 7 && $fixeddate->endMonth >= 7)
                        {

                            $addstartmonth = ($fixeddate->startMonth + 6) - 12;
                            $addendmonth = ($fixeddate->endMonth + 6) - 12;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year +1;

                        }elseif($fixeddate->startMonth <= 6 && $fixeddate->endMonth >= 7)
                        {

                            $addstartmonth = $fixeddate->startMonth + 6;
                            $addendmonth = ($fixeddate->endMonth + 6) - 12;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year +1;

                        }elseif($fixeddate->startMonth >= 7 && $fixeddate->endMonth <= 6)
                        {

                            $addstartmonth = ($fixeddate->startMonth + 6) - 12;
                            $addendmonth = $fixeddate->endMonth + 6;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year;
                        }
                        $fixeddate->save();

                        Http::post($fixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $fixeddate->user->name . "**, Greetings from GoodyMinder*:scream:!",
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "This is your Semi-Annually Due Date of " .$fixeddate->details. "** \n**Due:** " .$fixeddate->getendmonth() . " " .$fixeddate->endDay . ", " .$fixeddate->year,
                                    'color' => '63294',
                                ]
                            ],
                        ]);
                     }elseif($fixeddate->endDay > Carbon::now()->day ){
                        Http::post($fixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $fixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "**" . $days_remaining . "** day(s) left. \n **Due:** " . $fixeddate->getendmonth() . " " . $fixeddate->endDay . ", " . $fixeddate->year,
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                     }

                }
        }
    }

    public function fixDateNotifyQuarterly(){
        $yearNow = Carbon::now()->year;
        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;

        $fixeddates = FixedDate::where('year', '<=', $yearNow)
        ->where('startMonth', '<=', $monthNow)
        ->where('endMonth', '>=', $monthNow)
        ->where('startDay', '<=', $dayNow)
        ->where('frequency', 'like', 'Quarterly')
        ->get();

        foreach($fixeddates as $fixeddate){

            if($fixeddate->endMonth >= $monthNow ){

                if($fixeddate->endMonth == $monthNow){

                    $days_remaining = $fixeddate->endDay - $dayNow;
                }else{
                    if($fixeddate->endMonth == 1 || $fixeddate->endMonth == 3 || $fixeddate->endMonth == 5 || $fixeddate->endMonth == 7 || $fixeddate->endMonth == 8 || $fixeddate->endMonth == 9 || $fixeddate->endMonth == 10 || $fixeddate->endMonth == 12){                            
                                       $days_remaining = ($fixeddate->endDay + 31) - $dayNow;
                    }elseif($fixeddate->endMonth == 4 || $fixeddate->endMonth == 6 || $fixeddate->endMonth == 9 || $fixeddate->endMonth == 11){
                        $days_remaining = ($fixeddate->endDay + 31) - $dayNow;
                    }else{
                        if(date('L', strtotime(Carbon::now())) == 0){

                        $days_remaining = ($fixeddate->endDay + 28) - $dayNow;
                        }else {

                        $days_remaining = ($fixeddate->endDay + 29) - $dayNow;
                        }
                    }

                }

                     if($fixeddate->endDay == Carbon::now()->day){
                        if($fixeddate->startMonth <= 9 && $fixeddate->endMonth <= 9)
                        {
                            $addstartmonth = $fixeddate->startMonth + 3;
                            $addendmonth = $fixeddate->endMonth + 3;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year;

                        }elseif($fixeddate->startMonth >= 10 && $fixeddate->endMonth >= 10)
                        {

                            $addstartmonth = ($fixeddate->startMonth + 3) - 12;
                            $addendmonth = ($fixeddate->endMonth + 3) - 12;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year +1;
                             }elseif($fixeddate->startMonth <= 9 && $fixeddate->endMonth >= 10)
                        {

                            $addstartmonth = $fixeddate->startMonth + 3;
                            $addendmonth = ($fixeddate->endMonth + 3) - 12;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year +1;

                        }elseif($fixeddate->startMonth >= 10 && $fixeddate->endMonth <= 9)
                        {

                            $addstartmonth = ($fixeddate->startMonth + 3) - 12;
                            $addendmonth = $fixeddate->endMonth + 3;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year;
                            

                        }

                        $fixeddate->save();

                        Http::post($fixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $fixeddate->user->name . "**, Greetings from GoodyMinder*:scream:!",
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "*This is your Quarterly Due Date for* **" .$fixeddate->details . "** \n**Due:** " .$fixeddate->getendmonth() . " " .$fixeddate->endDay . ", " .$fixeddate->year,
                                    'color' => '63294',
                                ]
                            ],
                        ]);
                         }elseif($fixeddate->endDay > Carbon::now()->day ){
                        Http::post($fixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $fixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "**" . $days_remaining . "** day(s) left. \n **Due:** " . $fixeddate->getendmonth() . " " . $fixeddate->endDay . ", " . $fixeddate->year,
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                     }


                }
        }
    }
         public function fixDateNotifyMonthly(){
        $yearNow = Carbon::now()->year;
        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;

        $fixeddates = FixedDate::where('year', '<=', $yearNow)
        ->where('startMonth', '<=', $monthNow)
        ->where('endMonth', '>=', $monthNow)
        ->where('startDay', '<=', $dayNow)
        ->where('frequency', 'like', 'Monthly')
        ->get();

        foreach($fixeddates as $fixeddate){

            if($fixeddate->endMonth >= $monthNow ){
                if($fixeddate->endMonth == $monthNow){
                    $days_remaining = $fixeddate->endDay - $dayNow;
                }else{
                    if($fixeddate->endMonth == 1 || $fixeddate->endMonth == 3 || $fixeddate->endMonth == 5 || $fixeddate->endMonth == 7 || $fixeddate->endMonth == 8 || $fixeddate->endMonth == 9 || $fixeddate->endMonth == 10 || $fixeddate->endMonth == 12){                                
                    $days_remaining = ($fixeddate->endDay + 31) - $dayNow;
                    }elseif($fixeddate->endMonth == 4 || $fixeddate->endMonth == 6 || $fixeddate->endMonth == 9 || $fixeddate->endMonth == 11){
                        $days_remaining = ($fixeddate->endDay + 31) - $dayNow;
                    }else{
                        if(date('L', strtotime(Carbon::now())) == 0){
                        $days_remaining = ($fixeddate->endDay + 28) - $dayNow;
                        }else {
                        $days_remaining = ($fixeddate->endDay + 29) - $dayNow;
                        }
                    }
                }
                     if($fixeddate->endDay == Carbon::now()->day){
                        if($fixeddate->startMonth <= 11 && $fixeddate->endMonth <= 11)
                        {
                            $addstartmonth = $fixeddate->startMonth + 1;
                            $addendmonth = $fixeddate->endMonth + 1;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year;
                        }elseif($fixeddate->startMonth >= 12 && $fixeddate->endMonth >= 12)
                        {

                            $addstartmonth = ($fixeddate->startMonth + 1) - 12;
                            $addendmonth = ($fixeddate->endMonth + 1) - 12;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year +1;

                        }elseif($fixeddate->startMonth <= 11 && $fixeddate->endMonth >= 12)
                        {

                            $addstartmonth = $fixeddate->startMonth + 1;
                            $addendmonth = ($fixeddate->endMonth + 1) - 12;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year +1;

                        }elseif($fixeddate->startMonth >= 12 && $fixeddate->endMonth <= 11)
                        {

                            $addstartmonth = ($fixeddate->startMonth + 1) - 12;
                            $addendmonth = $fixeddate->endMonth + 1;
                            $fixeddate->startMonth = $addstartmonth;
                            $fixeddate->endMonth = $addendmonth;
                            $fixeddate->year = Carbon::now()->year;
                            }

                        $fixeddate->save();
                        Http::post($fixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $fixeddate->user->name . "**, Greetings from GoodyMinder*:scream:!",
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "This is your Monthly Due Date for " .$fixeddate->details,
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }elseif($fixeddate->endDay > Carbon::now()->day ){
                        Http::post($fixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $fixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "**" . $days_remaining . "** day(s) left. \n **Due:** " . $fixeddate->getendmonth() . " " . $fixeddate->endDay . ", " . $fixeddate->year,
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                     }

                }
        }
    }

/**  ============== unfixeddate reminder ================== */
public function unfixedDateNotifyMonthly() {

    $yearNow = Carbon::now()->year;
    $monthNow = Carbon::now()->month;
    $weekNow = Carbon::now()->weekOfMonth;
    $dayNow = Carbon::now()->dayOfWeek;

    $unfixeddates = UnfixedDate::where('year', '<=', $yearNow)
    ->where('month', '<=', $monthNow)
    ->where('week', '>=', $weekNow)
    ->where('day', '>=', $dayNow)
    ->where('frequency', 'like', 'Monthly')
    ->get();
    

    foreach($unfixeddates as $unfixeddate){

        if($unfixeddate->week == $weekNow && $unfixeddate->day >  $dayNow){

            if($unfixeddate->day == 0){
                
                Http::post($unfixeddate->webhook, [
                    'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                    'embeds' => [
                        [
                            'title' => $unfixeddate->details,
                            'description' => " Your due date is on Sunday \n **Due:** " . $unfixeddate->getDate(),
                            'color' => '16234752',
                        ]
                    ],
                ]);
            }elseif($unfixeddate->day == 1){
    
                Http::post($unfixeddate->webhook, [
                    'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                    'embeds' => [
                        [
                            'title' => $unfixeddate->details,
                            'description' => " Your due date is on Monday \n **Due:** " . $unfixeddate->getDate(),
                            'color' => '16234752',
                        ]
                    ],
                ]);
            }elseif($unfixeddate->day == 2){
    
                Http::post($unfixeddate->webhook, [
                    'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                    'embeds' => [
                        [
                            'title' => $unfixeddate->details,
                            'description' => " Your Due date is on Tuesday \n **Due:** " . $unfixeddate->getDate(),
                            'color' => '16234752',
                        ]
                    ],
                     ]);
            }elseif($unfixeddate->day == 3){
    
                Http::post($unfixeddate->webhook, [
                    'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                    'embeds' => [
                        [
                            'title' => $unfixeddate->details,
                            'description' => " Your due date is on Wednesday \n **Due:** " . $unfixeddate->getDate(),
                            'color' => '16234752',
                        ]
                    ],
                ]);
            }elseif($unfixeddate->day == 4){
    
                Http::post($unfixeddate->webhook, [
                    'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                    'embeds' => [
                        [
                            'title' => $unfixeddate->details,
                            'description' => " Your due date is on Thursday \n **Due:** " . $unfixeddate->getDate(),
                            'color' => '16234752',
                        ]
                    ],
                ]);
            }elseif($unfixeddate->day == 5){
    
                Http::post($unfixeddate->webhook, [
                    'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                    'embeds' => [
                        [
                            'title' => $unfixeddate->details,
                            'description' => " Your Due date is on Friday \n **Due:** " . $unfixeddate->getDate(),
                            'color' => '16234752',
                             ]
                    ],
                ]);
            }elseif($unfixeddate->day == 6){
    
                Http::post($unfixeddate->webhook, [
                    'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                    'embeds' => [
                        [
                            'title' => $unfixeddate->details,
                            'description' => " Your due date is on Saturday \n **Due:** " . $unfixeddate->getDate(),
                            'color' => '16234752',
                        ]
                    ],
                ]);
            }
        }elseif($unfixeddate->month >= $monthNow){ 
            if($unfixeddate->week == Carbon::now()->weekOfMonth && $unfixeddate->day ==  Carbon::now()->dayOfWeek){
    
                        if($unfixeddate->month <= 11 )
                        {
                            $addmonth = $unfixeddate->month + 1;
                            $unfixeddate->month = $addmonth;
                           $unfixeddate->year = Carbon::now()->year;

                        }elseif($unfixeddate->month >= 12)
                        {

                            $addmonth = ($unfixeddate->month + 1) - 12;
                            $unfixeddate->month = $addmonth;
                            $unfixeddate->year = Carbon::now()->year +1;



}
                       $unfixeddate->save(); 
    
                       Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :scream:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Today is your Due date \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '63294',
                                ]
                            ],
                        ]);
    
                    }
            }
        }
        }
public function unfixedDateNotifyQuarterly(){
    $yearNow = Carbon::now()->year;
    $monthNow = Carbon::now()->month;
    $weekNow = Carbon::now()->weekOfMonth;
    $dayNow = Carbon::now()->dayOfWeek;

    $unfixeddates = UnfixedDate::where('year', '<=', $yearNow)
    ->where('month', '<=', $monthNow)
    ->where('week', '>=', $weekNow)
    ->where('day', '>=', $dayNow)
    ->where('frequency', 'like', 'Quarterly')
    ->get();
    

    foreach($unfixeddates as $unfixeddate){
         if($unfixeddate->frequency == 'Quarterly'){

            if($unfixeddate->month >= $monthNow){ 


                if($unfixeddate->week == $weekNow && $unfixeddate->day >  $dayNow){

                    if($unfixeddate->day == 0){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Sunday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                                  ],
                        ]);
                    }elseif($unfixeddate->day == 1){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Monday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 2){

                        Http::post($unfixeddate->webhook, [
                             'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your Due date is on Tuesday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 3){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your Due date is on Wednesday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 4){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your Due date is on Thursday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 5){
                        
                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Friday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 6){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                   'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Saturday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }
                }elseif($unfixeddate->week == $weekNow && $unfixeddate->day ==  $dayNow){

                    if($unfixeddate->month <= 11 )
                        {
                            $addmonth = $unfixeddate->month + 3;
                            $unfixeddate->month = $addmonth;
                           $unfixeddate->year = Carbon::now()->year;

                        }elseif($unfixeddate->month >= 12)
                        {
                             
                            $addmonth = ($unfixeddate->month + 3) - 12;
                            $unfixeddate->month = $addmonth;
                            $unfixeddate->year = Carbon::now()->year +1;



                        }
                       $unfixeddate->save(); 
                    Http::post($unfixeddate->webhook, [
                        'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :scream:!" ,
                        'embeds' => [
                            [
                                'title' => $unfixeddate->details,
                                'description' => " Today is your due date \n **Due:** " . $unfixeddate->getDate(),
                                'color' => '63294',
                            ]
                             ],
                    ]);
                }
            }   

            }
            }
}

public function unfixedDateNotifySemiAnnually(){
    $yearNow = Carbon::now()->year;
    $monthNow = Carbon::now()->month;
    $weekNow = Carbon::now()->weekOfMonth;
    $dayNow = Carbon::now()->dayOfWeek;

    $unfixeddates = UnfixedDate::where('year', '<=', $yearNow)
    ->where('month', '<=', $monthNow)
     ->where('week', '>=', $weekNow)
    ->where('day', '>=', $dayNow)
    ->where('frequency', 'like', 'SemiAnnually')
    ->get();
    

    foreach($unfixeddates as $unfixeddate){

        if($unfixeddate->frequency == 'SemiAnnually'){

            if($unfixeddate->month >= $monthNow){ 


                if($unfixeddate->week == $weekNow && $unfixeddate->day >  $dayNow){

                    if($unfixeddate->day == 0){
                         Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Sunday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 1){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your Due date is on Monday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 2){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Tuesday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                         }elseif($unfixeddate->day == 3){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Wednesday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 4){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                 [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your Due date is on Thursday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 5){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Friday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                                 ],
                        ]);
                    }elseif($unfixeddate->day == 6){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Saturday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }
                }elseif($unfixeddate->week == $weekNow && $unfixeddate->day ==  $dayNow){
                    if($unfixeddate->month <= 7 )
                        {
                            $addmonth = $unfixeddate->month + 6;
                            $unfixeddate->month = $addmonth;
                           $unfixeddate->year = Carbon::now()->year;

                        }elseif($unfixeddate->month >= 8)
                        {

                            $addmonth = ($unfixeddate->month + 6) - 12;
                            $unfixeddate->month = $addmonth;
                            $unfixeddate->year = Carbon::now()->year +1;



                        }
                       $unfixeddate->save(); 
                        Http::post($unfixeddate->webhook, [
                        'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :scream:!" ,
                        'embeds' => [
                            [
                                'title' => $unfixeddate->details,
                                'description' => " Today is your due date \n **Due:** " . $unfixeddate->getDate(),
                                'color' => '63294',
                            ]
                        ],
                    ]);
                }
            }   

            }
            }
}

public function unfixedDateNotifyAnnually(){
    $yearNow = Carbon::now()->year;
    $monthNow = Carbon::now()->month;
    $weekNow = Carbon::now()->weekOfMonth;
    $dayNow = Carbon::now()->dayOfWeek;

    $unfixeddates = UnfixedDate::where('year', '<=', $yearNow)
    ->where('month', '<=', $monthNow)
    ->where('week', '>=', $weekNow)
    ->where('day', '>=', $dayNow)
    ->where('frequency', 'like', 'Annually')
    ->get();
    

    foreach($unfixeddates as $unfixeddate){
          if($unfixeddate->frequency == 'Annually'){
            if($unfixeddate->month >= $monthNow){ 


                if($unfixeddate->week == $weekNow && $unfixeddate->day >  $dayNow){

                    if($unfixeddate->day == 0){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Sunday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                             ]);
                    }elseif($unfixeddate->day == 1){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Monday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 2){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Tuesday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 3){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Wednesday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                    ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 4){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Thursday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 5){
                         Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Friday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }elseif($unfixeddate->day == 6){

                        Http::post($unfixeddate->webhook, [
                            'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :wink:!" ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Your due date is on Saturday \n **Due:** " . $unfixeddate->getDate(),
                                    'color' => '16234752',
                                ]
                            ],
                        ]);
                    }
                }elseif($unfixeddate->week == $weekNow && $unfixeddate->day ==  $dayNow){


                    $unfixeddate->year = Carbon::now()->year +1;
                    $unfixeddate->save(); 

                    Http::post($unfixeddate->webhook, [
                        'content' => ":loudspeaker: *Hello **". $unfixeddate->user->name . "**, Greetings from GoodyMinder* :scream:!" ,
                        'embeds' => [
                            [
                                'title' => $unfixeddate->details,
                                 'description' => " Today is your due date \n **Due:** " . $unfixeddate->getDate(),
                                'color' => '63294',
                            ]
                        ],
                    ]);
                }
            }   
            }
            }
}
}



