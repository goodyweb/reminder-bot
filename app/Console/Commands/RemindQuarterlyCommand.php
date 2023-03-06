<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindQuarterlyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:daily2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind me everyday';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return app()->call('App\Http\Controllers\ReminderController@fixDateNotifyQuarterly');
    }
}
