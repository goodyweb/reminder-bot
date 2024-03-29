<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindAnnuallyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:daily1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind me everyday with annually';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return app()->call('App\Http\Controllers\ReminderController@fixDateNotifyAnnually');
    }
}
