<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindEveryMinutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:minutes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind everyminutes usually meetings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return app()->call('App\Http\Controllers\PostGuzzleController@notificationEveryMinutes');
    }
}
