<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscordNotificationController extends Controller
{
    public function notification()
    {
        return Http::post('https://discord.com/api/webhooks/1075711731327848478/RsKhkCk68Bcj9FRU7nFhMrmBlMpCpxKGCYEbO9ntMdwW57b9JNayPXMn8_QT7Yhjx9jn', [
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