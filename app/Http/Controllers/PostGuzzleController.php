<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
 
class PostGuzzleController extends Controller
{

    public function triggerNotificstion(){
        
    }
    public function notification()
    {

        return Http::post('https://discord.com/api/webhooks/1076018435655475290/kPKW5L5Nfeh6TRuvqzQpYAdW8qLAVpfpOxllTwgzvdKf4UbHM1FlyUNMEzDzpw-Wo8rz', [
            'content' => "Remind Me every minute!",
            'embeds' => [
                [
                    'title' => "Reminders everyMinute!",
                    'description' => "it will reminds every minute!",
                    'color' => '7506394',
                ]
            ],
        ]);

    }
    public function notification1()
    {
        return Http::post('https://discord.com/api/webhooks/1076018435655475290/kPKW5L5Nfeh6TRuvqzQpYAdW8qLAVpfpOxllTwgzvdKf4UbHM1FlyUNMEzDzpw-Wo8rz', [
            'content' => "Remind Me every five minutes!",
            'embeds' => [
                [
                    'title' => "Reminders every five Minute!",
                    'description' => "it will reminds every 5 minutes!",
                    'color' => '7506394',
                ]
            ],
        ]);

    }
}
