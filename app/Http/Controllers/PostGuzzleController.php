<?php
 
namespace App\Http\Controllers;
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

        //$results = User::all();
        $results = Reminders::all();
        //$results = Reminder::where('id','like', 2)->get();

        
        foreach($results as $result){
            /**if($result->type == "daily"){
            
            
                return Http::post($result->webhook, [
                    'content' => $result->content,
                    'embeds' => [
                        [
                            'title' => $result->title,
                            'description' => $result->description,
                            'color' => '7506394',
                        ]
                    ],
                ]);
            }*/
            
            
                $date = date_create($result->stopped_at);
                
                $dateDisplay = date_format($date, "F d, Y H:i:s"); 
                $dateDisplay1 = date_format($date, "F d, Y "); 
                $setDate = strtotime($dateDisplay);
                $remaining = $setDate - time();
                $days_remaining = floor($remaining / 86400);
                $hours_remaining = floor(($remaining % 86400) / 3600);
                

                return Http::post($result->webhook, [
                    'content' => $result->content,
                    'embeds' => [
                        [
                            'title' => $result->title,
                            'description' => $result->description . " \n" . $dateDisplay1 . " \n" . $days_remaining . " days and ". $hours_remaining . " hours left",
                            'color' => '7506394',
                        ]
                    ],
                ]);
            
        }
        //return view('remind-bot.index')->with('results', $results);
    }
    public function testView()
    {
        $results = Reminders::find(1);
        return view('reminder_view.view')->with('results', $results);
    }
}
