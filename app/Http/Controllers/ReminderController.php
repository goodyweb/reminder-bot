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
    public function unfixedDadteNotification() {

        $unfixeddates = UnfixedDate::all();

        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;


        


        foreach($unfixeddates as $unfixeddate){
            if($unfixeddate->month == 1){

                selectDate($unfixeddate->id);
                
            }elseif($unfixeddate->month == 2){

            }elseif($unfixeddate->month == 3){

            }elseif($unfixeddate->month == 4){

            }elseif($unfixeddate->month == 5){

            }elseif($unfixeddate->month == 6){

            }elseif($unfixeddate->month == 7){

            }elseif($unfixeddate->month == 8){

            }elseif($unfixeddate->month == 9){

            }elseif($unfixeddate->month == 10){

            }elseif($unfixeddate->month == 11){

            }elseif($unfixeddate->month == 12){

            }
           
        if($unfixeddate->frequency == 'Monthly'){
            if($unfixeddate->month == $monthNow ){

                if($unfixeddate->month == $monthNow){
                   
                    $days_remaining = $unfixeddate->endDay - $dayNow;
                }else{
                    if($unfixeddate->month == 1 || $unfixeddate->month == 3 || $unfixeddate->month == 5 || $unfixeddate->month == 7 || $unfixeddate->month == 8 || $unfixeddate->month == 10 || $unfixeddate->month == 12){
                        $days_remaining = ($unfixeddate->endDay + 31) - $dayNow;
                    }elseif($unfixeddate->month == 4 || $unfixeddate->month == 6 || $unfixeddate->month == 9 || $unfixeddate->month == 11){
                        $days_remaining = ($unfixeddate->endDay + 31) - $dayNow;
                    }else{
                        if(date('L', strtotime(Carbon::now())) == 0){
                            
                        $days_remaining = ($unfixeddate->endDay + 28) - $dayNow;
                        }else {
                            
                        $days_remaining = ($unfixeddate->endDay + 29) - $dayNow;
                        }
                    }
                   
                }
                
                     if($unfixeddate->endDay == Carbon::now()->day){
            
                        
                        if($unfixeddate->month <= 11)
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
                            'content' => "Hello, Good day ". $unfixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => "This is your scheduled day of  Monthly" .$unfixeddate->details,
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }elseif($unfixeddate->endDay > Carbon::now()->day ){
                        Http::post($unfixeddate->webhook, [
                            'content' => "Hello, Good day ". $unfixeddate->user->name ,
                            'embeds' => [
                                [
                                    'title' => $unfixeddate->details,
                                    'description' => $days_remaining . " days left this is test ",
                                    'color' => '7506394',
                                ]
                            ],
                        ]);
                     }
            }

        }elseif($unfixeddate->frequency == 'Quarterly'){

            Http::post($unfixeddate->webhook, [
                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                'embeds' => [
                    [
                        'title' => $unfixeddate->details,
                        'description' => $days_remaining . " days left this is test ",
                        'color' => '7506394',
                    ]
                ],
            ]);
        }elseif($unfixeddate->frequency == 'Annually'){
            
            Http::post($unfixeddate->webhook, [
                'content' => "Hello, Good day ". $unfixeddate->user->name ,
                'embeds' => [
                    [
                        'title' => $unfixeddate->details,
                        'description' => $days_remaining . " days left this is test ",
                        'color' => '7506394',
                    ]
                ],
            ]);
        }
        
    }
    }

    public function selectDate($id){


        if($unfixeddate->week == 1){
            if($unfixeddate->day == 1){
                
            }elseif($unfixeddate->day == 2){

            }elseif($unfixeddate->day == 3){

            }else if($unfixeddate->day == 4){

            }elseif($unfixeddate->day == 5){

            }elseif($unfixeddate->day == 6){

            }elseif($unfixeddate->day == 7){

            }

        }elseif($unfixeddate->week == 2){
            if($unfixeddate->day == 1){

            }elseif($unfixeddate->day == 2){

            }elseif($unfixeddate->day == 3){

            }else if($unfixeddate->day == 4){

            }elseif($unfixeddate->day == 5){

            }elseif($unfixeddate->day == 6){

            }elseif($unfixeddate->day == 7){

            }
        }elseif($unfixeddate->week == 3){
            if($unfixeddate->day == 1){

            }elseif($unfixeddate->day == 2){

            }elseif($unfixeddate->day == 3){

            }else if($unfixeddate->day == 4){

            }elseif($unfixeddate->day == 5){

            }elseif($unfixeddate->day == 6){

            }elseif($unfixeddate->day == 7){

            }
        }elseif($unfixeddate->week == 4){
            if($unfixeddate->day == 1){

            }elseif($unfixeddate->day == 2){

            }elseif($unfixeddate->day == 3){

            }else if($unfixeddate->day == 4){

            }elseif($unfixeddate->day == 5){

            }elseif($unfixeddate->day == 6){

            }elseif($unfixeddate->day == 7){

            }
        }
    }
    
}
