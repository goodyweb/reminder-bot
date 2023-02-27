<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindEveryHourCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind me Every hour';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return app()->call('App\Http\Controllers\PostGuzzleController@notificationEveryHour');
    }
}
