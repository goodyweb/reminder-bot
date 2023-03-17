<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindMonthlyUnfixedDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:unfixedmonthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return app()->call('App\Http\Controllers\ReminderController@unfixedDateNotification');
    }
}
