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

        //$countdowns = User::all();
        $countdowns = Reminders::all();
        //$countdowns = Reminder::where('id','like', 2)->get();

        
        foreach($countdowns as $countdown){
            /**if($countdown->type == "daily"){
            
            
                return Http::post($countdown->webhook, [
                    'content' => $countdown->content,
                    'embeds' => [
                        [
                            'title' => $countdown->title,
                            'description' => $countdown->description,
                            'color' => '7506394',
                        ]
                    ],
                ]);
            }*/
            
            
                $date = date_create($countdown->dateend, timezone_open('Asia/Manila'));
                
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

       

        //return view('remind-bot.index')->with('countdowns', $countdowns);
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
