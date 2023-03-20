<?php

namespace App\Http\Controllers;

use App\Models\FixedDate;
use App\Models\UnfixedDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ReminderController extends Controller
{
  
    public function fixDateNotifyAnnually(){

        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;
        $yearNow = Carbon::now()->year;

        $fixeddates = FixedDate::where('startMonth', '<=', $monthNow)
        ->where('endMonth', '>=', $monthNow)
        ->where('startDay', '<=', $dayNow)
        ->where('frequency', 'like', 'Annually')
        ->get();

        foreach($fixeddates as $fixeddate){

            if($fixeddate->endMonth >= $monthNow ){

                
                
                if($fixeddate->endMonth == $monthNow  && $fixeddate->year == Carbon::now()->year){
                   
                    $days_remaining = $fixeddate->endDay - $dayNow;
                }else{
                    if($fixeddate->endMonth == 1 || $fixeddate->endMonth == 3 || $fixeddate->endMonth == 5 || $fixeddate->endMonth == 7 || $fixeddate->endMonth == 8 || $fixeddate->endMonth == 10 || $fixeddate->endMonth == 12){
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
                
                     if($fixeddate->endDay == Carbon::now()->day && $fixeddate->endMonth == Carbon::now()->month){
                        $addstartmonth = $fixeddate->startMonth;
                        $addendmonth = $fixeddate->endMonth;
                        $fixeddate->startMonth = $addstartmonth;
                        $fixeddate->endMonth = $addendmonth;
                        $fixeddate->year = Carbon::now()->year + 1;
                        $fixeddate->save();

                        Http::post($fixeddate->webhook, [
                            'content' => "Hello, Good day ". $fixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "This is your scheduled day of it works Annually " .$fixeddate->details,
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }elseif($fixeddate->endDay > Carbon::now()->day && $fixeddate->endMonth == Carbon::now()->month && $fixeddate->year == Carbon::now()->year){
                        Http::post($fixeddate->webhook, [
                            'content' => "Hello, Good day ". $fixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => $days_remaining . " days left",
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }


                    
    
            }
           
            
        }
    }
    public function fixDateNotifyQuarterly(){

        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;

        $fixeddates = FixedDate::where('startMonth', '<=', $monthNow)
        ->where('endMonth', '>=', $monthNow)
        ->where('startDay', '<=', $dayNow)
        ->where('frequency', 'like', 'Quarterly')
        ->get();

        foreach($fixeddates as $fixeddate){

            if($fixeddate->endMonth >= $monthNow ){

                if($fixeddate->endMonth == $monthNow){
                   
                    $days_remaining = $fixeddate->endDay - $dayNow;
                }else{
                    if($fixeddate->endMonth == 1 || $fixeddate->endMonth == 3 || $fixeddate->endMonth == 5 || $fixeddate->endMonth == 7 || $fixeddate->endMonth == 8 || $fixeddate->endMonth == 10 || $fixeddate->endMonth == 12){
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
                            'content' => "Hello, Good day ". $fixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "This is your scheduled day of Quarterly " .$fixeddate->details,
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }elseif($fixeddate->endDay > Carbon::now()->day ){
                        Http::post($fixeddate->webhook, [
                            'content' => "Hello, Good day ". $fixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => $days_remaining . " days left ",
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }

           
                }   
        }
    }
    public function fixDateNotifyMonthly(){

        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;

        $fixeddates = FixedDate::where('startMonth', '<=', $monthNow)
        ->where('endMonth', '>=', $monthNow)
        ->where('startDay', '<=', $dayNow)
        ->where('frequency', 'like', 'Monthly')
        ->get();

        foreach($fixeddates as $fixeddate){

            if($fixeddate->endMonth >= $monthNow ){

                if($fixeddate->endMonth == $monthNow){
                   
                    $days_remaining = $fixeddate->endDay - $dayNow;
                }else{
                    if($fixeddate->endMonth == 1 || $fixeddate->endMonth == 3 || $fixeddate->endMonth == 5 || $fixeddate->endMonth == 7 || $fixeddate->endMonth == 8 || $fixeddate->endMonth == 10 || $fixeddate->endMonth == 12){
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
                            'content' => "Hello, Good day ". $fixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => "This is your scheduled day of  Monthly" .$fixeddate->details,
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }elseif($fixeddate->endDay > Carbon::now()->day ){
                        Http::post($fixeddate->webhook, [
                            'content' => "Hello, Good day ". $fixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $fixeddate->details,
                                    'description' => $days_remaining . " days left this is test ",
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }

                }   
        }
    }

/**  ============== unfixeddate reminder ================== */
    public function unfixedDateNotification() {

        $monthNow = Carbon::now()->month;
        $weekNow = Carbon::now()->weekOfMonth;
        $dayNow = Carbon::now()->dayOfWeek;

        $unfixeddates = UnfixedDate::where('month', '<=', $monthNow)
        ->where('week', '>=', $weekNow)
        ->where('day', '<=', $dayNow)
        ->where('frequency', 'like', 'Monthly')
        ->get();
        

        foreach($unfixeddates as $unfixeddate){

                if($unfixeddate->month == $monthNow){ 
                    
                    

                    if($unfixeddate->week == $weekNow && $unfixeddate->day ==  $dayNow){


                            //$unfixeddate->month = $monthNow + 1;
                            //$unfixeddate->week = $weekNow;
                            //$unfixeddate->day = $dayNow;
                            //$unfixeddate->save();
                            //$unfixeddate->save();

                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Today is Your Due date ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);

                            
                        
                    }elseif($unfixeddate->week == $weekNow && $unfixeddate->day >  $dayNow){
                        
                        if($unfixeddate->day == 0){

                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Sunday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 1){

                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Monday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 2){

                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Tuesday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 3){

                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Wednesday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 4){

                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Thursday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 5){

                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Friday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 6){

                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Saturday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }
                    }   
            }
        }
                }
    public function unfixedDateNotifyQuarterly(){
        $monthNow = Carbon::now()->month;
        $weekNow = Carbon::now()->weekOfMonth;
        $dayNow = Carbon::now()->dayOfWeek;

        $unfixeddates = UnfixedDate::all();
        

        foreach($unfixeddates as $unfixeddate){

            if($unfixeddate->frequency == 'Quarterly'){

                if($unfixeddate->month >= $monthNow){ 
                    
                
                    if($unfixeddate->week == $weekNow && $unfixeddate->day >  $dayNow){
                        
                        if($unfixeddate->day == 0){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Sunday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 1){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Monday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 2){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Tuesday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 3){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Wednesday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 4){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Thursday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 5){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Friday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 6){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Saturday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }
                    }elseif($unfixeddate->week == $weekNow && $unfixeddate->day ==  $dayNow){
                        Http::post($unfixeddate->webhook, [
                            'content' => "Hello, Good day ". $unfixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Today is Your Due date ",
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                    }
                }   
                
                }
                }
    }

    public function unfixedDateNotifyAnnually(){
        $monthNow = Carbon::now()->month;
        $weekNow = Carbon::now()->weekOfMonth;
        $dayNow = Carbon::now()->dayOfWeek;

        $unfixeddates = UnfixedDate::all();
        

        foreach($unfixeddates as $unfixeddate){

           if($unfixeddate->frequency == 'Annually'){
                if($unfixeddate->month >= $monthNow){ 
                    
                
                    if($unfixeddate->week == $weekNow && $unfixeddate->day >  $dayNow){
                        
                        if($unfixeddate->day == 0){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Sunday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 1){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Monday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 2){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Tuesday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 3){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Wednesday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 4){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Thursday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 5){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Friday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }elseif($unfixeddate->day == 6){
                
                            Http::post($unfixeddate->webhook, [
                                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                                'embeds' => [
                                    [
                                        'title' => $unfixeddate->details,
                                        'description' => " Your Due date is on Saturday ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        }
                    }elseif($unfixeddate->week == $weekNow && $unfixeddate->day ==  $dayNow){
                
                
                        Http::post($unfixeddate->webhook, [
                            'content' => "Hello, Good day ". $unfixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => " Today is Your Due date ",
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                    }
                }   
                }
                }
    }
}
