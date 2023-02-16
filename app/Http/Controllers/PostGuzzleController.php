<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
 
class PostGuzzleController extends Controller
{
    public function notification()
    {
        return Http::post('https://discord.com/api/webhooks/1075708882908885063/gZ5ngJlKh2o43RTMJeA8ZNdVM_pwAUCiVNN5aWiNomCgHd_GCHqpwTvmKJ-wQ8uVdbkr', [
            'content' => "Remind Me!",
            'embeds' => [
                [
                    'title' => "An awesome new notification!",
                    'description' => "Discord Webhooks are great!",
                    'color' => '7506394',
                ]
            ],
        ]);

    }
}
