<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscordNotificationController extends Controller
{
    public function notification()
    {
        return Http::post('https://discord.com/api/webhooks/1075674306446635058/WtJOVdaft8lx8cw9A8S11YI6uxE2fAv-JBH8WYGKG0teQlNG-mcQrP7GSe0cjk9wxRgz', [
            'content' => "Learning how to send notifications with goodyweb.com.ph!",
            'embeds' => [
                [
                    'title' => "Reminder",
                    'description' => "5:00 is approaching!",
                    'color' => '7506394',
                ]
            ],
        ]);

    }
}