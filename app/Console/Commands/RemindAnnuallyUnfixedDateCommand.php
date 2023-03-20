<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemindAnnuallyUnfixedDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:unfixedannually';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Annually';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return app()->call('App\Http\Controllers\ReminderController@unfixedDateNotifyAnnually');
    }
}