<?php
 
namespace App\Http\Controllers;

use Carbon\carbon;
use App\Models\User;
use App\Models\Reminders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Console\Scheduling\Schedule;
 
class PostGuzzleController extends Controller
{

    public function triggerNotification(){
        
    }
    public function notification()
    {

        $countdowns = Reminders::all();
       
        
        foreach($countdowns as $countdown){
          
            if($countdown->type2 == "reminders")
            {
                if($countdown->type == "Months" && $countdown->type2 == "reminders")
                {
                    $this->everyMonth();
                }elseif($countdown->type == "Days" && $countdown->type2 == "reminders")
                {
                    $this->everyDay();
                }elseif($countdown->type == "Hours" && $countdown->type2 == "reminders")
                {
                    $this->everyHour();
                }elseif($countdown->type == "Minutes" && $countdown->type2 == "reminders")
                {
                    $this->everyMinute();
                }
                
            }elseif($countdown->type2 == "countdown"){
                if($countdown->type == "Months" && $countdown->type2 == "countdown")
                {
                    $this->everyMonth();
                }elseif($countdown->type == "Days" && $countdown->type2 == "countdown")
                {
                    $this->everyDay();
                }elseif($countdown->type == "Hours" && $countdown->type2 == "countdown")
                {
                    $this->everyHour();
                }elseif($countdown->type == "Minutes" && $countdown->type2 == "countdown")
                {
                    $this->everyMinute();
                }
            } 
        }

      
    }
    public function everyMonth(){

        
            $bookings = Reminders::where('dateend', '<=', Carbon::now()->addMonth()->toDateTimeString())
                    ->where('dateend', '>', Carbon::now()->toDateTimeString())
                    ->where('type', 'like', 'Months')
                    ->where('type2', 'like', 'reminders')
                    ->get();

                    foreach($bookings as $booking){


                        //identifies what to remind (months/days/hours/minutes/seconds to diplay)
                        if($booking->type == "Months" && $booking->notif == "monthly"){
                            $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
                        
                            $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                            $dateDisplay1 = date_format($date, "F d, Y "); 
                            $setDate = strtotime($dateDisplay);
                            $remaining = $setDate - time();
                            $days_remaining = floor($remaining/60/60/24);
                            $months_remaining = floor(($remaining/60/60/24)*30);
                            $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                            $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                            $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                            
            
                            return Http::post($booking->webhook, [
                                'content' => $booking->content,
                                'embeds' => [
                                    [
                                        'title' => $booking->title,
                                        'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $months_remaining . " months " . $days_remaining . " days ". $hours_remaining . " hours and ". $minutes_remaining . " minutes and ". $seconds_remaining . " seconds left ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        
            
                            $booking->notified = 1;
                            $booking->save();
                        }elseif($booking->type == "Days" && $booking->notif == "monthly"){
                            $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
                        
                            $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                            $dateDisplay1 = date_format($date, "F d, Y "); 
                            $setDate = strtotime($dateDisplay);
                            $remaining = $setDate - time();
                            $days_remaining = floor($remaining/60/60/24);
                            $months_remaining = floor(($remaining/60/60/24)*30);
                            $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                            $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                            $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                            
            
                            return Http::post($booking->webhook, [
                                'content' => $booking->content,
                                'embeds' => [
                                    [
                                        'title' => $booking->title,
                                        'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days ". $hours_remaining . " hours and ". $minutes_remaining . " minutes and ". $seconds_remaining . " seconds left ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        
            
                            $booking->notified = 1;
                            $booking->save();
                        }elseif($booking->type == "Just Days" && $booking->notif == "monthly"){
                            $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
                        
                            $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                            $dateDisplay1 = date_format($date, "F d, Y "); 
                            $setDate = strtotime($dateDisplay);
                            $remaining = $setDate - time();
                            $days_remaining = floor($remaining/60/60/24);
                            $months_remaining = floor(($remaining/60/60/24)*30);
                            $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                            $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                            $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                            
            
                            return Http::post($booking->webhook, [
                                'content' => $booking->content,
                                'embeds' => [
                                    [
                                        'title' => $booking->title,
                                        'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days left ",
                                        'color' => '7506394',
                                    ]
                                ],
                            ]);
                        
            
                            $booking->notified = 1;
                            $booking->save();
                        }
                    }
                
    }
    public function everyDay(){
        $bookings = Reminders::where('dateend', '<=', Carbon::now()->addDay()->toDateTimeString())
        ->where('dateend', '>', Carbon::now()->toDateTimeString())
        ->where('type2', 'like', 'reminders')
        ->get();

        foreach($bookings as $booking){
            
            //identifies what to remind (months/days/hours/minutes/seconds to diplay)
            if($booking->type == "Months" && $booking->notif == "daily"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $months_remaining . " months " . $days_remaining . " days ". $hours_remaining . " hours and ". $minutes_remaining . " minutes and ". $seconds_remaining . " seconds left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            

                $booking->notified = 1;
                $booking->save();
            }elseif($booking->type == "Days" && $booking->notif == "daily"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days ". $hours_remaining . " hours and ". $minutes_remaining . " minutes and ". $seconds_remaining . " seconds left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            
            }elseif($booking->type == "Just Days" && $booking->notif == "daily"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            

                $booking->notified = 1;
                $booking->save();
            }
        }
    }

    public function everyHour(){
        $bookings = Reminders::where('dateend', '<=', Carbon::now()->addHour()->toDateTimeString())
        ->where('dateend', '>', Carbon::now()->toDateTimeString())
        ->where('type2', 'like', 'reminders')
        ->get();

        foreach($bookings as $booking){
            
            //identifies what to remind (months/days/hours/minutes/seconds to diplay)
            if($booking->type == "Months" && $booking->notif == "hourly"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $months_remaining . " months " . $days_remaining . " days ". $hours_remaining . " hours and ". $minutes_remaining . " minutes and ". $seconds_remaining . " seconds left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            

                $booking->notified = 1;
                $booking->save();
            }elseif($booking->type == "Days" && $booking->notif == "hourly"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days ". $hours_remaining . " hours and ". $minutes_remaining . " minutes and ". $seconds_remaining . " seconds left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            
            }elseif($booking->type == "Just Days" && $booking->notif == "hourly"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            

                $booking->notified = 1;
                $booking->save();
            }
        }
    }
    public function everyMinute(){
        $bookings = Reminders::where('dateend', '<=', Carbon::now()->add(20, 'minutes')->toDateTimeString())
        ->where('dateend', '>', Carbon::now()->toDateTimeString())
        ->where('type2', 'like', 'reminders')
        ->get();

        foreach($bookings as $booking){

            //identifies what to remind (months/days/hours/minutes/seconds to diplay)
            if($booking->type == "Months" && $booking->notif == "minutes"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $months_remaining . " months " . $days_remaining . " days ". $hours_remaining . " hours and ". $minutes_remaining . " minutes and ". $seconds_remaining . " seconds left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            

                $booking->notified = 1;
                $booking->save();
            }elseif($booking->type == "Days" && $booking->notif == "minutes"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days ". $hours_remaining . " hours and ". $minutes_remaining . " minutes and ". $seconds_remaining . " seconds left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            

                $booking->notified = 1;
                $booking->save();
            }elseif($booking->type == "Just Days" && $booking->notif == "minutes"){
                $date = date_create($booking->dateend, timezone_open('Asia/Manila'));
            
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining/60/60/24);
                $months_remaining = floor(($remaining/60/60/24)*30);
                $hours_remaining = floor(($remaining-($days_remaining*60*60*24))/60/60);
                $minutes_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))/60);
                $seconds_remaining = floor(($remaining-($days_remaining*60*60*24)-($hours_remaining*60*60))-($minutes_remaining*60));
                

                return Http::post($booking->webhook, [
                    'content' => $booking->content,
                    'embeds' => [
                        [
                            'title' => $booking->title,
                            'description' => $booking->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days left ",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            

                $booking->notified = 1;
                $booking->save();
            }
        }
    }
    public function notifyCountdown(){

        $countdowns = Countdowns::All();

        foreach($countdowns as $countdown){
            if($countdown->type == "weekdays")
            $date = date_create($countdown->dateend);
                
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining / 86400);
                $hours_remaining = floor(($remaining % 86400) / 3600);
                

                return Http::post($countdown->webhook, [
                    'content' => $countdown->content,
                    'embeds' => [
                        [
                            'title' => $countdown->title,
                            'description' => $countdown->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days and ". $hours_remaining . " hours left",
                            'color' => '7506394',
                        ]
                    ],
                ]);

        }
    }
    public function show($id)
    {
        $carbonTime = Carbon::now()->toDateTimeString();
        $results = Reminders::find($id);
        return view('reminder_view.show', compact('results', 'carbonTime'));
    }
}
