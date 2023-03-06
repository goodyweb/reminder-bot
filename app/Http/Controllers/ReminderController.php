<?php

namespace App\Http\Controllers;

use App\Models\FixedDate;
use App\Models\UnfixedDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ReminderController extends Controller
{
    private function updateMonthFixDate($id)
    {

       // $addmonth = 0;
        $fixeddate = FixedDate::find($id);
        
        if($fixeddate->frequency == "Annually" && $fixeddate->endMonth == Carbon::now()->month && $fixeddate->startDay == Carbon::now()->day)
        {
            $addmonth = $fixeddate->endMonth;
            $fixeddate->startMonth = $addmonth;
            $fixeddate->endMonth = $addmonth;
            $fixeddate->save();
            

        }elseif($fixeddate->frequency == "Quarterly" && $fixeddate->endMonth == Carbon::now()->month && $fixeddate->endDay == Carbon::now()->day)
            {
                $addmonth = $fixeddate->endMonth + 3;
                $fixeddate->startMonth = $addmonth;
                $fixeddate->endMonth = $addmonth;
                $fixeddate->save();
                

            }elseif($fixeddate->frequency == "Monthly" && $fixeddate->endMonth == Carbon::now()->month && $fixeddate->endDay == Carbon::now()->day)
            {
                $addmonth = $fixeddate->endMonth + 1;
                $fixeddate->startMonth = $addmonth;
                $fixeddate->endMonth = $addmonth;
                $fixeddate->save();
                
            }

            
        
        
    }
    public function fixDateNotify(){

        $monthNow = Carbon::now()->month;
        $dayNow = Carbon::now()->day;

        $fixeddates = FixedDate::where('startMonth', '<=', $monthNow)
        ->where('startDay', '<=', $dayNow)
        ->get();

        foreach($fixeddates as $fixeddate){

            if($fixeddate->endMonth <= $monthNow ){

                $days_remaining = $fixeddate->endDay - $dayNow;
                
               $fixeddated = FixedDate::find($fixeddate->id);
        
                if($fixeddate->frequency == "Annually" && $fixeddate->endMonth == Carbon::now()->month && $fixeddate->startDay == Carbon::now()->day)
                {
                    $addmonth = $fixeddated->endMonth +1;
                    $fixeddated->startMonth = $addmonth;
                    $fixeddated->endMonth = $addmonth;
                    $fixeddated->save();

                     Http::post($fixeddated->webhook, [
                        'content' => "Hello, Good day ". $fixeddated->user->name ,
                        'embeds' => [
                            [
                                'title' => $fixeddated->details,
                                'description' => $days_remaining . " days left ",
                                'color' => '7506394',
                            ]
                        ],
                    ]);

                }elseif($fixeddate->frequency == "Quarterly" && $fixeddate->endMonth == Carbon::now()->month && $fixeddate->startDay == Carbon::now()->day)
                {
                   $addmonth = $fixeddated->endMonth + 3;
                    $fixeddated->startMonth = $addmonth;
                    $fixeddated->endMonth = $addmonth;
                    $fixeddated->save();
                    
                     Http::post($fixeddated->webhook, [
                        'content' => "Hello, Good day ". $fixeddated->user->name ,
                        'embeds' => [
                            [
                                'title' => $fixeddated->details,
                                'description' => $days_remaining . " days left ",
                                'color' => '7506394',
                            ]
                        ],
                    ]);
    
                }elseif($fixeddate->frequency == "Monthly" && $fixeddate->endMonth == Carbon::now()->month && $fixeddate->startDay == Carbon::now()->day)
                {
                    $addmonth = $fixeddated->endMonth + 1;
                    $fixeddated->startMonth = $addmonth;
                    $fixeddated->endMonth = $addmonth;
                    $fixeddated->save();

                     Http::post($fixeddated->webhook, [
                        'content' => "Hello, Good day ". $fixeddated->user->name ,
                        'embeds' => [
                            [
                                'title' => $fixeddated->details,
                                'description' => $days_remaining . " days left ",
                                'color' => '7506394',
                            ]
                        ],
                    ]);
                    
                }
    
            }
           
            
        }
        return $fixeddates;
    }
}
