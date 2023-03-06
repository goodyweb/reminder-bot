<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindMonthlyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:daily3';

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
        return app()->call('App\Http\Controllers\ReminderController@fixDateNotifyMonthly');
    }
}
