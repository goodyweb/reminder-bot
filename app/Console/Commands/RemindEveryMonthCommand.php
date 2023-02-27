<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindEveryMonthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind every month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return app()->call('App\Http\Controllers\PostGuzzleController@notificationEveryMonth');
    }
}
