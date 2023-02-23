<?php

namespace App\Console\Commands;
use App\Controllers\PostGuzzleController;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use App\Models\Reminders;

class remindCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder';

   
    public function handle()
    {
     
   

       return app()->call('App\Http\Controllers\PostGuzzleController@notification');

        /** Http::post('https://discord.com/api/webhooks/1076018435655475290/kPKW5L5Nfeh6TRuvqzQpYAdW8qLAVpfpOxllTwgzvdKf4UbHM1FlyUNMEzDzpw-Wo8rz', [
            'content' => "Remind Me every minute!",
            'embeds' => [
                [
                    'title' => "Reminders everyMinute!",
                    'description' => "it will reminds every minute!",
                    'color' => '7506394',
                ]
            ],
        ]);
        return 0;
        */
    }
}
